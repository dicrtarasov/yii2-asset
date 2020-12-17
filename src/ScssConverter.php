<?php
/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license proprietary
 * @version 17.12.20 13:12:14
 */

declare(strict_types = 1);
namespace dicr\asset;

use ScssPhp\ScssPhp\Compiler;
use ScssPhp\ScssPhp\OutputStyle;
use Throwable;
use Yii;
use yii\base\Component;
use yii\base\Exception;
use yii\web\AssetConverterInterface;

use function array_unique;
use function basename;
use function dirname;
use function file_get_contents;
use function file_put_contents;
use function filemtime;
use function is_file;
use function strrpos;
use function strtolower;
use function substr;

use const LOCK_EX;
use const YII_ENV_DEV;

/**
 * Быстрый PHP-компилятор SCSS.
 * Быстродействие намного выше запуска стандартной внешней команды sass и сравнимо с командой sassc.
 *
 * @link https://scssphp.github.io/scssphp/docs/
 */
class ScssConverter extends Component implements AssetConverterInterface
{
    /** @var string стиль вывода (ScssPhp\ScssPhp\OutputStyle::*) */
    public $outputStyle;

    /** @var bool включить генерацию карт */
    public $sourceMap;

    /**
     * @var string[] список зависимостей
     * Если список зависимостей общий и фиксированный, то чтобы при разработке не включать force,
     * можно определить файлы, изменения которых отслеживать для перекомпиляции.
     * Можно указывать через алиасы как например '@webroot/res/...'
     */
    public $depends = [];

    /**
     * @var bool перекомпилировать, независимо от времени модификации источника.
     * Требуется при разработке, если не задано `depends` так как файл может включать другие,
     * изменение которых отследить нельзя.
     */
    public $force;

    /**
     * @inheritDoc
     */
    public function init() : void
    {
        parent::init();

        if ($this->outputStyle === null) {
            $this->outputStyle = YII_ENV_DEV ? OutputStyle::EXPANDED : OutputStyle::COMPRESSED;
        }

        if (! isset($this->sourceMap)) {
            $this->sourceMap = YII_ENV_DEV;
        }

        if (! isset($this->force)) {
            $this->force = YII_ENV_DEV;
        }

        // проверяем файлы зависимостей
        if (! empty($this->depends)) {
            foreach ($this->depends as $idx => &$alias) {
                $file = Yii::getAlias($alias);
                if ($file !== false && is_file($file)) {
                    $alias = $file;
                } else {
                    Yii::error('Зависимый файл не существует: ' . $alias, __METHOD__);
                    unset($this->depends[$idx]);
                }
            }

            unset($alias);
        }

        if ($this->force === null) {
            $this->force = YII_ENV_DEV && empty($this->depends);
        }
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function convert($asset, $basePath) : string
    {
        try {
            return $this->compile($basePath, $asset);
        } catch (Throwable $ex) {
            if (YII_ENV_DEV) {
                throw new Exception('Ошибка компиляции: ' . $asset, 0, $ex);
            }

            Yii::error($ex, __METHOD__);
        }

        return $asset;
    }

    /**
     * Создает компилятор.
     * Так как он не очищается после компиляции каждого файла, то требуется пересоздание.
     *
     * @return Compiler
     */
    protected function createCompiler() : Compiler
    {
        // создаем и инициализируем компилятор
        $compiler = new Compiler();

        $compiler->setEncoding('utf-8');

        if (! empty($this->outputStyle)) {
            $compiler->setOutputStyle($this->outputStyle);
        }

        $compiler->setSourceMap(
            $this->sourceMap ? Compiler::SOURCE_MAP_FILE : Compiler::SOURCE_MAP_NONE
        );

        return $compiler;
    }

    /**
     * Возвращает путь файла результата.
     *
     * @param string $asset относительный путь источника
     * @return ?string относительный путь результата или null, если конвертация не требуется
     */
    protected function getResultPath(string $asset) : ?string
    {
        // позиция расширения файла
        $pos = strrpos($asset, '.');
        if ($pos !== false) {
            // проверяем правильность расширения
            $ext = substr($asset, $pos + 1);
            if (strtolower($ext) === 'scss') {
                return substr($asset, 0, $pos) . '.css';
            }
        }

        return null;
    }

    /**
     * Определяет нужна ли перекомпиляция файла.
     *
     * @param string $src
     * @param string $dst
     * @return bool
     * @noinspection PhpUsageOfSilenceOperatorInspection
     */
    protected function needRecompile(string $src, string $dst) : bool
    {
        if ($this->force || ! @is_file($dst)) {
            return true;
        }

        // проверяем модификацию файла-источника вместе с остальными статическими зависимостями
        $depends = (array)($this->depends ?: []);
        $depends[] = $src;
        $dstTime = @filemtime($dst);

        foreach ($depends as $dep) {
            if (@filemtime($dep) > $dstTime) {
                return true;
            }
        }

        return false;
    }

    /**
     * Компилирует файл.
     *
     * @param string $basePath
     * @param string $asset
     * @return string относительный путь файла результата или исходный файл
     * @throws Exception
     * @noinspection PhpUsageOfSilenceOperatorInspection
     */
    protected function compile(string $basePath, string $asset) : string
    {
        // получаем адрес назначения
        $result = $this->getResultPath($asset);
        if (empty($result)) {
            return $asset;
        }

        // абсолютный путь исходного файла и результата
        $src = $basePath . '/' . $asset;
        $dst = $basePath . '/' . $result;

        // если исходный файл не существует то ошибка
        if (! is_file($src)) {
            throw new Exception('Исходный файл не найден: ' . $src);
        }

        // если не нужно перекомпилировать то пропускаем
        if (! $this->needRecompile($src, $dst)) {
            return $result;
        }

        // читаем файл
        $scss = @file_get_contents($src);
        if ($scss === false) {
            throw new Exception('Ошибка чтения ресурса: ' . $src);
        }

        $compiler = $this->createCompiler();

        // устанавливаем базовый путь импорта файлов
        $compiler->setImportPaths(array_unique([
            dirname($src)
        ]));

        // sourceMap
        if ($this->sourceMap) {
            $baseName = basename($result);

            $compiler->setSourceMapOptions([
                // путь map-файла
                'sourceMapWriteTo' => $basePath . '/' . $result . '.map',
                // относительный url файла
                'sourceMapURL' => $baseName . '.map',
                // базовый путь исходного файла
                'sourceMapBasepath' => dirname($src),
                // относительный путь файла назначения
                'sourceMapFilename' => $baseName
            ]);
        }

        // компилируем
        try {
            $css = $compiler->compile($scss, $src);
        } catch (Throwable $ex) {
            throw new Exception('Ошибка компиляции ресурса: ' . $src . ': ' . $ex);
        }

        // сохраняем файл
        if (@file_put_contents($dst, $css, LOCK_EX) === false) {
            throw new Exception('Ошибка записи ресурса: ' . $dst);
        }

        Yii::debug('SCSS скомпилирован в : ' . $basePath . '/' . $result, __METHOD__);

        return $result;
    }
}
