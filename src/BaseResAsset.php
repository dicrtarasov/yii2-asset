<?php
/**
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license proprietary
 * @version 08.07.20 06:14:03
 */

declare(strict_types=1);
namespace dicr\asset;

use yii\base\InvalidConfigException;
use yii\helpers\Json;
use yii\web\AssetBundle;
use yii\web\View;
use function is_array;

/**
 * Базовый Asset для файлов в @web/res
 */
class BaseResAsset extends AssetBundle
{
    /** @inheritDoc */
    public $basePath = '@webroot/res';

    /** @inheritDoc */
    public $baseUrl = '@web/res';

    /**
     * @inheritDoc
     */
    public function init()
    {
        // конвертируем в массивы
        foreach (['css', 'js', 'depends'] as $field) {
            if (empty($this->{$field})) {
                $this->{$field} = [];
            } elseif (!is_array($this->{$field})) {
                $this->{$field} = [$this->{$field}];
            }
        }

        parent::init();
    }

    /**
     * Комбинированный метод для создания и регистрации
     *
     * @param View $view
     * @param array $config
     * @return static
     * @throws InvalidConfigException
     */
    public static function registerConfig(View $view, array $config)
    {
        $am = $view->getAssetManager();
        $asset = new static($config);
        $asset->publish($am);

        $key = static::class . '-' . md5(Json::encode($config));
        $assetManager = $view->getAssetManager();
        if (is_array($assetManager->bundles)) {
            /** @noinspection OffsetOperationsInspection */
            $assetManager->bundles[$key] = $asset;
        }

        $view->registerAssetBundle($key);
        return $asset;
    }
}
