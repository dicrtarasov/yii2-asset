<?php
namespace dicr\asset;

use yii\web\AssetBundle;
use yii\web\View;
use yii\helpers\Json;

/**
 * Базовый Asset для файлов в @web/res
 *
 * @author Igor (Dicr) Tarasov <develop@dicr.org>
 * @version 2019
 *
 */
class BaseResAsset extends AssetBundle {

	public $basePath = '@webroot/res';

	public $baseUrl = '@web/res';

	/**
	 * {@inheritDoc}
	 * @see \yii\web\AssetBundle::init()
	 */
	public function init() {

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
	 * @param \yii\web\View $view
	 * @param array $config
	 * @return static
	 */
	public static function registerConfig(View $view, array $config) {
	    $asset = new static($config);
	    $key = md5(Json::encode($config));
	    $view->getAssetManager()->bundles[$key] = $asset;
        $view->registerAssetBundle($key);
	    return $asset;
	}
}