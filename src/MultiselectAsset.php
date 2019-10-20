<?php
namespace dicr\asset;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

/**
 * Assets for Jquery Multiselect widget.
 *
 * @author Igor (Dicr) Tarasov <develop@dicr.org>
 * @version 2019
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
