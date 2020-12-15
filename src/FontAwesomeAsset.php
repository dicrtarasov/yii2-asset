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
    /** @inheritDoc  */
    public $baseUrl = 'https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5';

    /** @inheritDoc */
    public $css = [
        'css/all.min.css',
    ];

    /*
    public $js = [
        'js/all.min.js'
    ];
    */
}
