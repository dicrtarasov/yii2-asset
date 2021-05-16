<?php
/*
 * @copyright 2019-2021 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license proprietary
 * @version 17.05.21 02:09:22
 */

declare(strict_types = 1);
namespace dicr\asset;

use ScssPhp\ScssPhp\Compiler;
use ScssPhp\ScssPhp\Exception\SassException;
use ScssPhp\ScssPhp\OutputStyle;
use Throwable;
use Yii;
use yii\base\Component;
use yii\base\Exception;
use yii\helpers\FileHelper;
use yii\web\AssetConverterInterface;

use function array_unique;
use function dirname;
use function file_get_contents;
use function file_put_contents;
use function filemtime;
use function is_file;
use function strrpos;
use function strtolower;
use function substr;

use const DIRECTORY_SEPARATOR;
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
    public $outputStyle = OutputStyle::COMPRESSED;

    /** @var bool включить генерацию карт */
    public $sourceMap = YII_ENV_DEV;

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
    public function init(): void
    {
        parent::init();

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
    public function convert($asset, $basePath): string
    {
        try {
            return $this->convertAsset($basePath, $asset);
        } catch (Throwable $ex) {
            if (YII_ENV_DEV) {
                throw new Exception('Ошибка компиляции: ' . $asset, 0, $ex);
            }

            Yii::error($ex, __METHOD__);
        }

        return $asset;
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
    protected function convertAsset(string $basePath, string $asset): string
    {
        // получаем название файла результата
        $cssName = $this->cssName($asset);
        if ($cssName === null) {
            return $asset;
        }

        // абсолютный путь исходного файла
        $scssPath = $basePath . '/' . $asset;

        // если исходный файл не существует то ошибка
        if (! is_file($scssPath)) {
            throw new Exception('Исходный файл не найден: ' . $scssPath);
        }

        // абсолютный путь результата
        $cssPath = $this->resultPath($cssName);
        $cssUrl = $this->resultUrl($cssName);

        $cssDir = dirname($cssPath);
        if (! FileHelper::createDirectory($cssDir, 0755)) {
            throw new Exception('Ошибка создания директории: ' . $cssDir);
        }

        // если нужно перекомпилировать
        if ($this->needRecompile($scssPath, $cssPath)) {
            // читаем файл
            $scss = @file_get_contents($scssPath);
            if ($scss === false) {
                throw new Exception('Ошибка чтения ресурса: ' . $scssPath);
            }

            $compiler = $this->createCompiler();

            // устанавливаем базовый путь импорта файлов
            $compiler->setImportPaths(array_unique([
                dirname($scssPath)
            ]));

            // source map
            $mapName = $cssName . '.map';
            $mapPath = $this->resultPath($mapName);
            $mapUrl = $this->resultUrl($mapName);

            $compiler->setSourceMapOptions([
                // absolute path to write .map file
                'sourceMapWriteTo' => $mapPath,

                // relative or full url to the above .map file
                'sourceMapURL' => $mapUrl,

                // (optional) relative or full url to the .css file
                'sourceMapFilename' => $cssUrl,

                // базовый путь исходного файла
                'sourceMapBasepath' => dirname($scssPath),

                // (optional) prepended to 'source' field entries for relocating source files
                'sourceRoot' => '/'
            ]);

            // компилируем
            try {
                $result = $compiler->compileString($scss, $scssPath);
            } catch (SassException | Throwable $ex) {
                throw new Exception('Ошибка компиляции ресурса: ' . $scssPath . ': ' . $ex);
            }

            // сохраняем css-файл
            if (@file_put_contents($cssPath, $result->getCss(), LOCK_EX) === false) {
                throw new Exception('Ошибка записи ресурса: ' . $cssPath);
            }

            // сохраняем map-файл
            if ($this->sourceMap && @file_put_contents($mapPath, $result->getSourceMap(), LOCK_EX) === false) {
                throw new Exception('Ошибка записи ресурса: ' . $mapPath);
            }

            Yii::debug('SCSS скомпилирован в : ' . $cssPath, __METHOD__);
        }

        return $cssName;
    }

    /**
     * Создает компилятор.
     * Так как он не очищается после компиляции каждого файла, то требуется пересоздание.
     *
     * @return Compiler
     */
    protected function createCompiler(): Compiler
    {
        // создаем и инициализируем компилятор
        $compiler = new Compiler();

        if (! empty($this->outputStyle)) {
            $compiler->setOutputStyle($this->outputStyle);
        }

        $compiler->setSourceMap(
            $this->sourceMap ? Compiler::SOURCE_MAP_FILE : Compiler::SOURCE_MAP_NONE
        );

        return $compiler;
    }

    /**
     * Возвращает имя файла результата (меняет scss на css).
     *
     * @param string $asset относительный путь источника
     * @return ?string относительный путь результата или null, если конвертация не требуется
     */
    protected function cssName(string $asset): ?string
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
     * Возвращает полный путь результата.
     *
     * @param string $path
     * @return string
     */
    protected function resultPath(string $path): string
    {
        $assetManager = Yii::$app->assetManager;

        return Yii::getAlias($assetManager->basePath . DIRECTORY_SEPARATOR . ltrim($path, DIRECTORY_SEPARATOR));
    }

    /**
     * Возвращает полный URL результата.
     *
     * @param string $path относительный путь css
     * @return string
     */
    protected function resultUrl(string $path): string
    {
        $assetManager = Yii::$app->assetManager;

        return Yii::getAlias($assetManager->baseUrl . '/' . ltrim($path, '/'));
    }

    /**
     * Определяет нужна ли перекомпиляция файла.
     *
     * @param string $src
     * @param string $dst
     * @return bool
     * @noinspection PhpUsageOfSilenceOperatorInspection
     */
    protected function needRecompile(string $src, string $dst): bool
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
}
