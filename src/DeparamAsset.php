<?php
/**
 * @copyright 2019-2019 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license proprietary
 * @version 06.10.19 08:18:54
 */

declare(strict_types = 1);
namespace dicr\asset;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

/**
 * Функция jquery.deparam
 */
class DeparamAsset extends AssetBundle
{
    /** @var string */
    public $sourcePath = __DIR__ . '/assets/deparam';

    /** @var string[] */
    public $js = [
        'jquery.deparam.js'
    ];

    /** @var string[] */
    public $depends = [
        JqueryAsset::class
    ];
}
