<?php
/**
 * @copyright 2019-2019 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license proprietary
 * @version 06.04.19 02:15:29
 */

declare(strict_types = 1);
namespace dicr\asset;

use yii\web\AssetBundle;

/**
 * MomentJs
 */
class MomentJsAsset extends AssetBundle
{
    /** @var string[] */
    public $js = [
        'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.min.js'
    ];
}
