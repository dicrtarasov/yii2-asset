<?php
namespace dicr\asset;

use yii\web\AssetManager;

/**
 * ReactJs Asset
 *
 * @author Igor (Dicr) Tarasov <develop@dicr.org>
 * @version 2019
 *
 */
class ReactAsset extends AssetManager
{
    /** @var array */
    const JS = [
        YII_ENV_PROD => [
            'https://unpkg.com/react@16/umd/react.production.min.js',
            'https://unpkg.com/react-dom@16/umd/react-dom.production.min.js'
        ],
        YII_ENV_DEV => [
            'https://unpkg.com/react@16/umd/react.development.min.js',
            'https://unpkg.com/react-dom@16/umd/react-dom.development.min.js'
        ]
    ];

    /** @var string[] */
    public $depends = [
        BabelAsset::class
    ];

    /**
     * {@inheritDoc}
     * @see \yii\web\AssetManager::init()
     */
    public function init()
    {
        $this->js = self::JS[YII_ENV];
    }
}
