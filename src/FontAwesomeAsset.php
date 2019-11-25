<?php
/**
 * @copyright 2019-2019 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license proprietary
 * @version 21.08.19 19:31:38
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
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css'
    ];
}
