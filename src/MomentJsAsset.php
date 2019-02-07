<?php
namespace dicr\asset;

use yii\web\AssetBundle;

/**
 * MomentJs
 *
 * @author Igor (Dicr) Tarasov <develop@dicr.org>
 * @version 2019
 */
class MomentJsAsset extends AssetBundle {

    public $js = [
        'https://cdn.jsdelivr.net/npm/moment@2.24.0/min/moment-with-locales.min.js'
    ];

}