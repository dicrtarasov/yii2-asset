<?php
/**
 * @copyright 2019-2019 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license proprietary
 * @version 06.10.19 08:18:36
 */

declare(strict_types = 1);
namespace dicr\asset;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

/**
 * Ресурсы автоподсказки.
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
