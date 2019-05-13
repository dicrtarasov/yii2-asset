<?php
namespace dicr\asset;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

/**
 * Создает ползунок для изменения размера (модифицированная версия).
 *
 * @author Igor (Dicr) Tarasov <develop@dicr.org>
 * @version 2019
 * @link https://github.com/RickStrahl/jquery-resizable
 */
class ResizableAsset extends AssetBundle
{
    /** @var string */
    public $sourcePath = '@dicr/asset/assets/resizable';

    /** @var string[] */
    public $js = [
        'jquery.resizable.js'
    ];

    /** @var string[] */
    public $css = [
        'jquery.resizable.css'
    ];

    /** @var string[] */
    public $depends = [
        JqueryAsset::class
    ];
}