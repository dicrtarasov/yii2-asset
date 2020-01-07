<?php
/**
 * @copyright 2019-2019 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license proprietary
 * @version 20.05.19 05:29:34
 */

declare(strict_types=1);

namespace dicr\asset;

use yii\web\AssetBundle;

/**
 * ReactJs Asset
 *
 * @link https://reactjs.org
 */
class ReactAsset extends AssetBundle
{
    /** @var array */
    public const JS = [
        'prod' => [
            ['https://unpkg.com/react/umd/react.production.min.js', 'crossorigin' => true],
            ['https://unpkg.com/react-dom/umd/react-dom.production.min.js', 'crossorigin' => true]
        ],
        'dev' => [
            ['https://unpkg.com/react/umd/react.development.js', 'crossorigin' => true],
            ['https://unpkg.com/react-dom/umd/react-dom.development.js', 'crossorigin' => true]
        ]
    ];

    /**
     * {@inheritDoc}
     * @see \yii\web\AssetManager::init()
     */
    public function init()
    {
        $this->js = self::JS[YII_ENV_DEV ? 'dev' : 'prod'];

        parent::init();
    }
}
