<?php
namespace dicr\asset;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

/**
 * Ресурсы автоподсказки.
 *
 * @author Igor (Dicr) Tarasov <develop@dicr.org>
 * @version 2019
 */
class AutocompleteAsset extends AssetBundle
{
    /** @var string */
    public $sourcePath = __DIR__ . '/assets/autocomplete';

    /** @var string[] */
    public $js = [
        'https://cdnjs.cloudflare.com/ajax/libs/jquery.devbridge-autocomplete/1.4.10/jquery.autocomplete.min.js'
    ];

    /** @var string[] */
    public $css = [
        'autocomplete.css'
    ];

    /** @var string[] */
    public $depends = [
        JqueryAsset::class
    ];
}
