<?php
namespace dicr\asset;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

/**
 * Автодополнение.
 *
 * @author Igor (Dicr) Tarasov <develop@dicr.org>
 * @version 2019
 * @link https://github.com/devbridge/jQuery-Autocomplete
 * @link https://www.devbridge.com/sourcery/components/jquery-autocomplete/
 */
class AutocompleteAsset extends AssetBundle
{
    /** @var string[] */
    public $js = [
        'https://cdnjs.cloudflare.com/ajax/libs/jquery.devbridge-autocomplete/1.4.9/jquery.autocomplete.min.js'
    ];

    /** @var string[] */
    public $depends = [
        JqueryAsset::class
    ];
}