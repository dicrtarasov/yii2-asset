<?php
/**
 * @copyright 2019-2019 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license proprietary
 * @version 20.05.19 04:55:48
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
    /** @var string[] */
    public $js = [
        'https://unpkg.com/@babel/standalone/babel.min.js'
    ];
}
