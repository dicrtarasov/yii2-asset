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
    /** @inheritDoc */
    public $sourcePath = __DIR__ . '/assets/resizable';

    /** @inheritDoc */
    public $js = [
        'jquery.resizable.js'
    ];

    /** @inheritDoc */
    public $css = [
        'jquery.resizable.scss'
    ];

    /** @inheritDoc */
    public $depends = [
        JqueryAsset::class
    ];
}
