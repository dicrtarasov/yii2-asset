<?php
/**
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license proprietary
 * @version 26.07.20 11:25:43
 */

declare(strict_types = 1);
namespace dicr\asset;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

/**
 * Ресурсы Slick Carousel.
 *
 * @link https://kenwheeler.github.io/slick
 */
class SlickAsset extends AssetBundle
{
    /** @var string */
    public const CSS_THEME = 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css';

    /** @var bool включать тему */
    public $withTheme = false;

    /** @inheritDoc */
    public $css = [
        'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css',
    ];

    /** @inheritDoc */
    public $js = [
        'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js'
    ];

    /** @inheritDoc */
    public $depends = [
        JqueryAsset::class
    ];

    /**
     * @inheritDoc
     */
    public function init()
    {
        if ($this->withTheme) {
            $this->css[] = self::CSS_THEME;
        }

        parent::init();
    }
}
