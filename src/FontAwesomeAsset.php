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
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css'
    ];
}