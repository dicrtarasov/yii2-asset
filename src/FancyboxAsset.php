<?php
/**
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license proprietary
 * @version 26.07.20 10:56:38
 */

declare(strict_types = 1);
namespace dicr\asset;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

/**
 * Fancybox Asset.
 *
 * @link http://fancyapps.com/fancybox/3/ project page
 */
class FancyboxAsset extends AssetBundle
{
    /** @inheritDoc */
    public $baseUrl = 'https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3/dist';

    /** @inheritDoc */
    public $css = [
        'jquery.fancybox.min.css'
    ];

    /** @inheritDoc */
    public $js = [
        'jquery.fancybox.min.js'
    ];

    /** @inheritDoc */
    public $depends = [
        JqueryAsset::class
    ];
}
