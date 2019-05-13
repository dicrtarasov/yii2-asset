<?php
namespace dicr\asset;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

/**
 * Функция jquery.deparam
 *
 * @author Igor (Dicr) Tarasov <develop@dicr.org>
 * @version 2019
 */
class DeparamAsset extends AssetBundle
{
    /** @var string */
    public $sourcePath = '@dicr/asset/assets/deparam';

    /** @var string[] */
	public $js = [
		'jquery.deparam.js'
	];

	/** @var string[] */
	public $depends = [
		JqueryAsset::class
	];
}
