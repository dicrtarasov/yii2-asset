<?php
/**
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license proprietary
 * @version 08.07.20 06:14:14
 */

declare(strict_types = 1);
namespace dicr\asset;

use yii\web\AssetBundle;

/**
 * FontAwesome
 *
 * @link https://fontawesome.com/
 */
class FontAwesomeAsset extends AssetBundle
{
    /** @inheritDoc */
    public $css = [
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css',
    ];

    /*
    public $js = [
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js'
    ];
    */
}
