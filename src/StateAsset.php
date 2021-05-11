<?php
/*
 * @copyright 2019-2021 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license proprietary
 * @version 11.05.21 05:51:19
 */

declare(strict_types = 1);
namespace dicr\asset;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

/**
 * Класс State для совместного отслеживания состояний приложения разными компонентами.
 */
class StateAsset extends AssetBundle
{
    /** @inheritDoc */
    public $sourcePath = __DIR__ . '/assets/state';

    /** @inheritDoc */
    public $js = ['script.js'];

    /** @inheritDoc */
    public $depends = [
        JqueryAsset::class
    ];
}
