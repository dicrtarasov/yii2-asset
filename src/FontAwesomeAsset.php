<?php
namespace dicr\asset;

use yii\web\AssetBundle;

/**
 * FontAwesome
 *
 * @author Igor (Dicr) Tarasov <develop@dicr.org>
 * @version 2019
 * @link https://fontawesome.com/
 */
class FontAwesomeAsset extends AssetBundle
{
    /** @var string[] */
    public $css = [
        // 'https://use.fontawesome.com/releases/v5.8.1/css/all.css',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/all.min.css'
    ];
}