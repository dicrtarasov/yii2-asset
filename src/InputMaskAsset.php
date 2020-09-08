<?php
/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license proprietary
 * @version 09.09.20 03:19:01
 */

declare(strict_types = 1);
namespace dicr\asset;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

/**
 * RobinHerbots Inputmask.
 *
 * ```javascript
 * $(".phone-input").inputmask('+7 (999) 999-99-99');
 *
 * $(document).on("ajaxComplete", function(e){
 *     $(".phone-input").inputmask();
 * });
 * ```
 *
 * @link https://github.com/RobinHerbots/Inputmask
 */
class InputMaskAsset extends AssetBundle
{
    /** @inheritDoc */
    public $js = [
        'https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.5/jquery.inputmask.min.js'
    ];

    /** @inheritDoc */
    public $depends = [
        JqueryAsset::class
    ];
}
