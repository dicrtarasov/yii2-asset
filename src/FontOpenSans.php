<?php
/**
 * @copyright 2019-2019 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license proprietary
 * @version 24.04.19 00:30:57
 */

declare(strict_types = 1);
namespace dicr\asset;

use yii\web\AssetBundle;

/**
 * Шрифт OpenSans
 *
 * @link https://fonts.google.com/specimen/Open+Sans
 */
class FontOpenSans extends AssetBundle
{
    /** @var string[] */
    public $css = [
        'https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext'
    ];
}
