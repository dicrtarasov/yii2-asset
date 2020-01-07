<?php
/**
 * @copyright 2019-2019 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license proprietary
 * @version 06.04.19 03:24:55
 */

declare(strict_types=1);

namespace dicr\asset;

use yii\web\AssetBundle;

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
}
