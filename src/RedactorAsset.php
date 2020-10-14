<?php
/**
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license proprietary
 * @version 08.07.20 06:14:58
 */

declare(strict_types = 1);
namespace dicr\asset;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

use function in_array;

/**
 * Ресурсы редактора.
 */
class RedactorAsset extends AssetBundle
{
    /** @inheritDoc */
    public $sourcePath = __DIR__ . '/assets/redactor';

    /** @inheritDoc */
    public $css = [
        'redactor-fix.scss'
    ];

    /** @inheritDoc */
    public $js = [
        'redactor.min.js',
        'lang/ru.js'
    ];

    /** @inheritDoc */
    public $depends = [
        JqueryAsset::class
    ];

    /**
     * Добавляет ресурсы плагинов.
     *
     * @param string[] $plugins
     */
    public function addPluginsResources(array $plugins) : void
    {
        foreach ($plugins as $plugin) {
            $js = 'plugins/' . $plugin . '/' . $plugin . '.js';
            if (! in_array($js, $this->js) && file_exists($this->sourcePath . DIRECTORY_SEPARATOR . $js)) {
                $this->js[] = $js;
            }

            $css = 'plugins/' . $plugin . '/' . $plugin . '.css';
            if (! in_array($css, $this->css) && file_exists($this->sourcePath . DIRECTORY_SEPARATOR . $css)) {
                $this->css[] = $css;
            }
        }
    }
}
