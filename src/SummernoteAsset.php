<?php
/*
 * @copyright 2019-2021 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license proprietary
 * @version 12.08.21 23:17:18
 */

declare(strict_types = 1);
namespace dicr\asset;

use yii\bootstrap5\BootstrapAsset;
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
        BootstrapAsset::class
    ];
}
