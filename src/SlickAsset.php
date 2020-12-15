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
    /** @inheritDoc */
    public $baseUrl = 'https://cdn.jsdelivr.net/npm/slick-carousel@1/slick';

    /** @var string */
    public const CSS_THEME = 'slick-theme.min.css';

    /** @var bool включать тему */
    public $withTheme = false;

    /** @inheritDoc */
    public $css = [
        'slick.min.css',
    ];

    /** @inheritDoc */
    public $js = [
        'slick.min.js'
    ];

    /** @inheritDoc */
    public $depends = [
        JqueryAsset::class
    ];

    /**
     * @inheritDoc
     */
    public function init() : void
    {
        if ($this->withTheme) {
            $this->css[] = self::CSS_THEME;
        }

        parent::init();
    }
}
