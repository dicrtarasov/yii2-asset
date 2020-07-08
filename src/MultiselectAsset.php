<?php
/**
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license proprietary
 * @version 08.07.20 06:14:43
 */

declare(strict_types=1);
namespace dicr\asset;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

/**
 * Assets for Jquery Multiselect widget.
 *
 * @link https://github.com/nobleclem/jQuery-MultiSelect
 */
class MultiselectAsset extends AssetBundle
{
    /** @var string[] */
    public $css = [
        'https://cdn.jsdelivr.net/npm/@nobleclem/jquery-multiselect@2.4.16/jquery.multiselect.css',
    ];

    /** @var string[] */
    public $js = [
        'https://cdn.jsdelivr.net/npm/@nobleclem/jquery-multiselect@2.4.16/jquery.multiselect.js'
    ];

    /** @var string[] */
    public $depends = [
        JqueryAsset::class
    ];
}
