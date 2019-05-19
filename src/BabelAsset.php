<?php
namespace dicr\asset;

use yii\web\AssetBundle;

/**
 * Babel Asset.
 *
 * @author Igor (Dicr) Tarasov <develop@dicr.org>
 * @version 2019
 * @link https://babeljs.io
 */
class BabelAsset extends AssetBundle
{
    public $js = [
        'https://unpkg.com/babel-standalone'
    ];
}