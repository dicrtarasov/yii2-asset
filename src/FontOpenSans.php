<?php
namespace dicr\asset;

use yii\web\AssetBundle;

/**
 * Шрифт OpenSans
 *
 * @author Igor (Dicr) Tarasov <develop@dicr.org>
 * @version 2019
 * @link https://fonts.google.com/specimen/Open+Sans
 */
class FontOpenSans extends AssetBundle
{
    /** @var string[] */
    public $css = [
        'https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext'
    ];
}