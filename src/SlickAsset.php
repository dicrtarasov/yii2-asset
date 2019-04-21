<?php
namespace dicr\asset;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

/**
 * Slick-Carousel asset.
 *
 * @author Igor (Dicr) Tarasov <develop@dicr.org>
 * @version 2019
 * @link https://kenwheeler.github.io/slick
 */
class SlickAsset extends AssetBundle
{
    /** @var string[] */
    public $css = [
        'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css',
        'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css'
    ];

    /** @var string[] */
    public $js = [
        'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js'
    ];

    /** @var string[] */
    public $depends = [
        JqueryAsset::class
    ];
}
