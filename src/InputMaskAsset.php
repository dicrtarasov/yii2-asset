<?php
/**
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license proprietary
 * @version 23.02.20 09:20:00
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
    /** @var string[] */
    public $js = [
        'https://cdnjs.cloudflare.com/ajax/libs/inputmask/4.0.6/jquery.inputmask.bundle.min.js'
    ];

    /** @var string[] */
    public $depends = [
        JqueryAsset::class
    ];
}
