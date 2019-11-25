<?php
/**
 * @copyright 2019-2019 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license proprietary
 * @version 25.04.19 01:29:26
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
    /** @var string[] */
    public $css = [
        'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css'
    ];

    /** @var string[] */
    public $js = [
        'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js'
    ];

    /** @var string[] */
    public $depends = [
        JqueryAsset::class
    ];
}
