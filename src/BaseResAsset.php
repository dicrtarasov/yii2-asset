<?php
namespace dicr\asset;

use yii\web\AssetBundle;
use yii\web\View;

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
	 * Комбинированный метод для создания и регистрации
	 *
	 * @param \yii\web\View $view
	 * @param array $config
	 * @return static
	 */
	public static function register(View $view, array $config) {
	    $asset = new static($config);
	    $asset->registerAssetFiles($view);
	    return $asset;
	}
}