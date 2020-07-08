<?php
/**
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license proprietary
 * @version 08.07.20 06:13:55
 */

declare(strict_types=1);
namespace dicr\asset;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

/**
 * Ресурсы авто-дополнения.
 */
class AutocompleteAsset extends AssetBundle
{
    /** @var string */
    public $sourcePath = __DIR__ . '/assets/autocomplete';

    /** @var string[] */
    public $js = [
        'https://cdnjs.cloudflare.com/ajax/libs/jquery.devbridge-autocomplete/1.4.11/jquery.autocomplete.min.js'
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
