<?php
/**
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license proprietary
 * @version 08.07.20 06:14:06
 */

declare(strict_types=1);
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
