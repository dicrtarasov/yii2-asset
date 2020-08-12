<?php
/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license proprietary
 * @version 13.08.20 00:05:05
 */

declare(strict_types = 1);
namespace dicr\asset;

use ScssPhp\ScssPhp\Compiler;
use ScssPhp\ScssPhp\Formatter\Compact;
use ScssPhp\ScssPhp\Formatter\Compressed;
use ScssPhp\ScssPhp\Formatter\Crunched;
use ScssPhp\ScssPhp\Formatter\Expanded;
use ScssPhp\ScssPhp\Formatter\Nested;
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
 * PHP-конвертор SCSS.
 *
 * @link https://scssphp.github.io/scssphp/docs/
 */
class ScssConverter extends Component implements AssetConverterInterface
{
    /** @var string */
    public const FORMATTER_EXPANDED = Expanded::class;

    /** @var string */
    public const FORMATTER_NESTED = Nested::class;

    /** @var string */
    public const FORMATTER_COMPRESSED = Compressed::class;

    /** @var string */
    public const FORMATTER_COMPACT = Compact::class;

    /** @var string */
    public const FORMATTER_CRUNCHED = Crunched::class;

    /** @var int */
    public const SOURCE_MAP_NONE = Compiler::SOURCE_MAP_NONE;

    /** @var int */
    public const SOURCE_MAP_INLINE = Compiler::SOURCE_MAP_INLINE;

    /** @var int */
    public const SOURCE_MAP_FILE = Compiler::SOURCE_MAP_FILE;

    /** @var string */
    public $formatter;

    /** @var bool */
    public $sourceMap;

    /** @var bool перекомпилировать, независимо от свежести (необходимо при работе с mixein) */
    public $force;

    /** @var Compiler */
    private $compiler;

    /**
     * @inheritDoc
     */
    public function init()
    {
        parent::init();

        if (! isset($this->sourceMap)) {
            $this->sourceMap = YII_ENV_DEV;
        }

        if (! isset($this->formatter)) {
            $this->formatter = YII_ENV_DEV ? self::FORMATTER_EXPANDED : self::FORMATTER_CRUNCHED;
        }

        if (! isset($this->force)) {
            $this->force = YII_ENV_DEV;
        }

        $this->compiler = new Compiler();

        $this->compiler->setFormatter($this->formatter);

        $this->compiler->setSourceMap(
            $this->sourceMap ? Compiler::SOURCE_MAP_FILE : Compiler::SOURCE_MAP_NONE
        );
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function convert($asset, $basePath): string
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
     * Возвращает путь файла результата.
     *
     * @param string $asset относительный путь источника
     * @return ?string относительный путь результата или null, если конвертация не требуется
     */
    protected function getResultPath(string $asset): ?string
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
     * Компилирует файл.
     *
     * @param string $basePath
     * @param string $asset
     * @return string относительный путь файла результата или исходный файл
     * @throws Exception
     * @noinspection PhpUsageOfSilenceOperatorInspection
     */
    protected function compile(string $basePath, string $asset): string
    {
        // получаем адрес назначения
        $result = $this->getResultPath($asset);

        // если файл не поддерживается, то возвращаем без изменений
        if (empty($result)) {
            return $asset;
        }

        // абсолютный путь исходного файла и результата
        $src = $basePath . '/' . $asset;
        $dst = $basePath . '/' . $result;

        // если файл уже готов, то пропускаем
        if (! $this->force && @is_file($dst) && @filemtime($dst) >= @filemtime($src)) {
            return $result;
        }

        // читаем файл
        $scss = @file_get_contents($src);
        if ($scss === false) {
            throw new Exception('Ошибка чтения ресурса: ' . $src);
        }

        // устанавливаем базовый путь импорта файлов
        $this->compiler->setImportPaths(array_unique([
            $basePath,
            dirname($src)
        ]));

        // sourceMap
        if ($this->sourceMap) {
            $baseName = basename($result);

            $this->compiler->setSourceMapOptions([
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
            $css = $this->compiler->compile($scss, $src);
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
