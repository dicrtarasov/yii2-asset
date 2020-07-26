<?php
/**
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license proprietary
 * @version 08.07.20 06:14:51
 */

declare(strict_types=1);
namespace dicr\asset;

use yii\web\AssetBundle;

/**
 * React-Bootstrap asset.
 *
 * Для работы также нужен bootstrap.css 4-ой версии, но в зависимости не добавлен.
 *
 * @link https://react-bootstrap.github.io/getting-started/introduction
 */
class ReactBootstrapAsset extends AssetBundle
{
    /** @inheritDoc */
    public $js = [
        'https://unpkg.com/react-bootstrap@next/dist/react-bootstrap.min.js'
    ];

    /** @inheritDoc */
    public $depends = [
        ReactAsset::class
    ];
}
