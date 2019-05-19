<?php
namespace dicr\asset;

use yii\web\AssetBundle;

/**
 * ReactJs Asset
 *
 * @author Igor (Dicr) Tarasov <develop@dicr.org>
 * @version 2019
 * @link https://reactjs.org
 */
class ReactAsset extends AssetBundle
{
    /** @var array */
    const JS = [
        'prod' => [
            ['https://unpkg.com/react/umd/react.production.min.js', 'crossorigin' => true],
            ['https://unpkg.com/react-dom/umd/react-dom.production.min.js', 'crossorigin' => true]
        ],
        'dev' => [
            ['https://unpkg.com/react/umd/react.development.js', 'crossorigin' => true],
            ['https://unpkg.com/react-dom/umd/react-dom.development.js', 'crossorigin' => true]
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
        $this->js = self::JS[YII_ENV_DEV ? 'dev' : 'prod'];

        parent::init();
    }
}
