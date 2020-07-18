<?php
/**
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license proprietary
 * @version 08.07.20 06:14:34
 */

declare(strict_types = 1);
namespace dicr\asset;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

/**
 * Библиотека JqueryUI.
 */
class JuiAsset extends AssetBundle
{
    /** @inheritDoc */
    public $css = [
        'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css'
    ];

    /** @inheritDoc */
    public $js = [
        'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js'
    ];

    /** @inheritDoc */
    public $depends = [
        JqueryAsset::class
    ];
}
