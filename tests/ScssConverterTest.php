<?php
/*
 * @copyright 2019-2022 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license proprietary
 * @version 08.01.22 22:19:54
 */

declare(strict_types = 1);
namespace dicr\tests;

use PHPUnit\Framework\TestCase;
use Yii;

use function unlink;

/**
 * Class ScssConverterTest
 */
class ScssConverterTest extends TestCase
{
    /**
     * @inheritDoc
     * @noinspection PhpUsageOfSilenceOperatorInspection
     */
    public static function setUpBeforeClass(): void
    {
        // удаляем файл
        @unlink(__DIR__ . '/assets/test.css');
    }

    /**
     * Тест
     */
    public function testConvert() : void
    {
        $converter = Yii::$app->assetManager->getConverter();

        $result = $converter->convert(
            'test.scss', __DIR__ . '/assets'
        );

        self::assertSame('test.scss.css', $result);
    }

    /**
     * @inheritDoc
     * @noinspection PhpUsageOfSilenceOperatorInspection
     */
    public static function tearDownAfterClass(): void
    {
        // удаляем файл
        @unlink(__DIR__ . '/assets/test.css');
    }

}
