<?php
/**
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license proprietary
 * @version 08.07.20 06:14:09
 */

declare(strict_types=1);
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
    public $css = [
        'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css'
    ];

    /** @inheritDoc */
    public $js = [
        'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js'
    ];

    /** @inheritDoc */
    public $depends = [
        JqueryAsset::class
    ];
}
