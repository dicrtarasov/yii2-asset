<?php
/**
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license proprietary
 * @version 08.07.20 06:15:01
 */

declare(strict_types=1);
namespace dicr\asset;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

/**
 * Создает ползунок для изменения размера (модифицированная версия).
 *
 * @link https://github.com/RickStrahl/jquery-resizable
 */
class ResizableAsset extends AssetBundle
{
    /** @var string */
    public $sourcePath = __DIR__ . '/assets/resizable';

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
