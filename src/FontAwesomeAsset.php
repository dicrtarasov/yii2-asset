<?php
/**
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license proprietary
 * @version 15.06.20 18:02:30
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
    /** @var string[] */
    public $css = [
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css',
    ];

    /*
    public $js = [
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js'
    ];
    */
}
