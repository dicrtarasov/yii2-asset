<?php
namespace dicr\asset;

use yii\web\AssetBundle;

/**
 * Ресурсы редактора.
 *
 * @author Nghia Nguyen <yiidevelop@hotmail.com>
 * @author Igor (Dicr) Tarasov <develop@dicr.org>
 * @since 2.0
 * @version 2019
 */
class RedactorAsset extends AssetBundle
{
    /** @var string */
    public $sourcePath = __DIR__ . '/assets/redactor';

    /** @var string[] */
    public $css = [
        'redactor.min.css',
        'redactor-fix.css'
    ];

    /** @var string[] */
    public $js = [
        'redactor.min.js'
    ];
}
