<?php
/**
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license proprietary
 * @version 08.07.20 06:14:40
 */

declare(strict_types=1);
namespace dicr\asset;

use yii\web\AssetBundle;

/**
 * MomentJs
 */
class MomentJsAsset extends AssetBundle
{
    /** @inheritDoc */
    public $js = [
        'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/locale/ru.min.js'
    ];
}
