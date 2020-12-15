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
 * Библиотека DevBridge Autocomplete
 */
class AutocompleteAsset extends AssetBundle
{
    /** @inheritDoc */
    public $sourcePath = __DIR__ . '/assets/autocomplete';

    /** @inheritDoc */
    public $js = [
        'https://cdn.jsdelivr.net/npm/devbridge-autocomplete@1/dist/jquery.autocomplete.min.js'
    ];

    /** @inheritDoc */
    public $css = [
        'autocomplete.scss'
    ];

    /** @inheritDoc */
    public $depends = [
        JqueryAsset::class
    ];
}
