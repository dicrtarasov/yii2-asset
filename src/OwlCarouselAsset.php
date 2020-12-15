<?php
/**
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license proprietary
 * @version 26.07.20 11:07:05
 */

declare(strict_types = 1);
namespace dicr\asset;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

/**
 * OwlCarousel 2
 *
 * @link https://owlcarousel2.github.io/OwlCarousel2/
 */
class OwlCarouselAsset extends AssetBundle
{
    /** @inheritDoc */
    public $baseUrl = 'https://cdn.jsdelivr.net/npm/owl.carousel@2/dist';

    /** @inheritDoc */
    public $css = [
        'assets/owl.carousel.min.css',
        'assets/owl.theme.default.min.css'
    ];

    /** @inheritDoc */
    public $js = [
        'owl.carousel.min.js'
    ];

    /** @inheritDoc */
    public $depends = [
        JqueryAsset::class
    ];
}
