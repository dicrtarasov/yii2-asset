<?php
/**
 * @copyright 2019-2019 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license proprietary
 * @version 21.04.19 07:51:30
 */

declare(strict_types=1);

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
    /** @var string  */
    public const CSS_THEME = 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css';

    /** @var bool включать тему */
    public $withTheme = false;

    /** @var string[] */
    public $css = [
        'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css',
    ];

    /** @var string[] */
    public $js = [
        'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js'
    ];

    /** @var string[] */
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
