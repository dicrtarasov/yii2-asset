<?php
/*
 * @copyright 2019-2021 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license proprietary
 * @version 11.05.21 06:00:49
 */

/** @noinspection PhpUnhandledExceptionInspection */
declare(strict_types = 1);

/** */
const YII_DEBUG = true;
/** */
const YII_ENV = 'dev';

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

