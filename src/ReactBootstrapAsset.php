<?php
namespace dicr\asset;

use yii\web\AssetBundle;

/**
 * React-Bootstrap asset.
 *
 * Для работы также нужен bootstrap.css 4-ой версии, но в зависимости не добавлен.
 *
 * @author Igor (Dicr) Tarasov <develop@dicr.org>
 * @version 2019
 * @link https://react-bootstrap.github.io/getting-started/introduction
 */
class ReactBootstrapAsset extends AssetBundle
{
    /** @var string[] */
    public $js = [
        'https://unpkg.com/react-bootstrap@next/dist/react-bootstrap.min.js'
    ];

    /** @var string[] */
    public $depends = [
        ReactBootstrapAsset::class
    ];
}