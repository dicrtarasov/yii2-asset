<?php
/**
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license proprietary
 * @version 08.07.20 06:15:10
 */

declare(strict_types = 1);
namespace dicr\asset;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

/**
 * Summernote Asset Bundle.
 */
class SummernoteAsset extends AssetBundle
{
    /** @inheritDoc */
    public $baseUrl = 'https://cdn.jsdelivr.net/npm/summernote@0/dist';

    /** @inheritDoc */
    public $css = [
        'summernote-bs4.min.css'
    ];

    /** @inheritDoc */
    public $js = [
        'summernote-bs4.min.js'
    ];

    /** @inheritDoc */
    public $depends = [
        JqueryAsset::class,
        'yii\bootstrap4\BootstrapAsset'
    ];
}
