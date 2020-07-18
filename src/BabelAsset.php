<?php
/**
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license proprietary
 * @version 04.07.20 12:33:01
 */

declare(strict_types=1);
namespace dicr\asset;

use yii\web\AssetBundle;

/**
 * Babel Asset.
 *
 * @link https://babeljs.io
 */
class BabelAsset extends AssetBundle
{
    /** @inheritDoc */
    public $js = [
        'https://unpkg.com/@babel/standalone/babel.min.js'
    ];
}
