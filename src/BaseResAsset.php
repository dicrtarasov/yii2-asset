<?php
/**
 * @copyright 2019-2019 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license proprietary
 * @version 21.06.19 18:43:03
 */

declare(strict_types = 1);
namespace dicr\asset;

use yii\helpers\Json;
use yii\web\AssetBundle;
use yii\web\View;
use function is_array;

/**
 * Базовый Asset для файлов в @web/res
 */
class BaseResAsset extends AssetBundle
{
    /** @var string */
    public $basePath = '@webroot/res';

    /** @var string */
    public $baseUrl = '@web/res';

    /**
     * {@inheritDoc}
     * @see \yii\web\AssetBundle::init()
     */
    public function init()
    {
        // конвертируем в массивы
        foreach (['css', 'js', 'depends'] as $field) {
            if (empty($this->{$field})) {
                $this->{$field} = [];
            } elseif (! is_array($this->{$field})) {
                $this->{$field} = [$this->{$field}];
            }
        }

        parent::init();
    }

    /**
     * Комбинированный метод для создания и регистрации
     *
     * @param \yii\web\View $view
     * @param array $config
     * @return static
     * @throws \yii\base\InvalidConfigException
     */
    public static function registerConfig(View $view, array $config)
    {
        $am = $view->getAssetManager();
        $asset = new static($config);
        $asset->publish($am);

        $key = static::class . '-' . md5(Json::encode($config));
        $view->getAssetManager()->bundles[$key] = $asset;
        $view->registerAssetBundle($key);

        return $asset;
    }
}
