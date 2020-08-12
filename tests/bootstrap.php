<?php
/**
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license GPL
 * @version 29.07.20 08:24:33
 */

/** @noinspection PhpUnhandledExceptionInspection */
declare(strict_types = 1);

/** */
define('YII_DEBUG', true);
/** */
define('YII_ENV', 'dev');

require_once(dirname(__DIR__) . '/vendor/autoload.php');
require_once(dirname(__DIR__) . '/vendor/yiisoft/yii2/Yii.php');


Yii::setAlias('@webroot', __DIR__ . '/web');
Yii::setAlias('@web', '/');

new yii\web\Application([
    'id' => 'test-app',
    'basePath' => __DIR__,
    'components' => [
        'cache' => yii\caching\ArrayCache::class,

        'request' => [
            'scriptFile' => __FILE__,
            'scriptUrl' => '/',
        ],
        'assetManager' => [
            'converter' => [
                'class' => dicr\asset\ScssConverter::class,
            ]
        ]
    ]
]);

