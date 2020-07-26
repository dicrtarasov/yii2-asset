<?php
/**
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license proprietary
 * @version 26.07.20 10:56:16
 */

declare(strict_types = 1);
namespace dicr\asset;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

/**
 * WooCommerce FlexSlider - слайдер и карусель.
 *
 * @link Demo http://flexslider.woothemes.com
 * @link Homepage https://woocommerce.com/flexslider/
 * @link Options https://github.com/woocommerce/FlexSlider/wiki/FlexSlider-Properties
 */
class FlexSliderAsset extends AssetBundle
{
    /** @inheritDoc */
    public $css = [
        'https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.7.2/flexslider.min.css'
    ];

    /** @inheritDoc */
    public $js = [
        'https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.7.2/jquery.flexslider.min.js'
    ];

    /** @inheritDoc */
    public $depends = [
        JqueryAsset::class
    ];
}
