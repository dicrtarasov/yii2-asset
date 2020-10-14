<?php
/**
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license proprietary
 * @version 08.07.20 06:14:48
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
     * @inheritDoc
     */
    public function init() : void
    {
        $this->js = self::JS[YII_ENV_DEV ? 'dev' : 'prod'];

        parent::init();
    }
}
