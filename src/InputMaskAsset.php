<?php
namespace dicr\asset;

use yii\web\AssetBundle;

/**
 * RobinHerbots Inputmask
 *
 * @author Igor (Dicr) Tarasov <develop@dicr.org>
 * @version 2019
 * @link https://github.com/RobinHerbots/Inputmask
 */
class InputMaskAsset extends AssetBundle
{
	/** @var string[] */
	public $js = [
	    'https://cdnjs.cloudflare.com/ajax/libs/inputmask/4.0.6/jquery.inputmask.bundle.min.js'
	];
}
