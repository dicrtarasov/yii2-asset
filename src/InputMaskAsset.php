<?php
/**
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license proprietary
 * @version 08.07.20 06:14:24
 */

declare(strict_types = 1);
namespace dicr\asset;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

/**
 * RobinHerbots Inputmask
 *
 * @link https://github.com/RobinHerbots/Inputmask
 */
class InputMaskAsset extends AssetBundle
{
    /** @inheritDoc */
    public $js = [
        'https://cdnjs.cloudflare.com/ajax/libs/inputmask/4.0.9/jquery.inputmask.bundle.min.js'
    ];

    /** @inheritDoc */
    public $depends = [
        JqueryAsset::class
    ];
}
