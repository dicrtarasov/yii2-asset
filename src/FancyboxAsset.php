<?php
namespace dicr\asset;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

/**
 * Fancybox Asset.
 *
 * @author Igor (Dicr) Tarasov <develop@dicr.org>
 * @version 2019
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