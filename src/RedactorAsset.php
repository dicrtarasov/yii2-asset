<?php
/**
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license proprietary
 * @version 08.07.20 06:14:58
 */

declare(strict_types=1);
namespace dicr\asset;

use Yii;
use yii\web\AssetBundle;
use yii\web\JqueryAsset;
use function in_array;

/**
 * Ресурсы редактора.
 */
class RedactorAsset extends AssetBundle
{
    /** @var string */
    public $sourcePath = __DIR__ . '/assets/redactor';

    /** @var string[] */
    public $css = [
        'redactor.min.css',
        'redactor-fix.css'
    ];

    /** @var string[] */
    public $js = [
        'redactor.min.js'
    ];

    /** @var string[] */
    public $depends = [
        JqueryAsset::class
    ];

    /**
     * {@inheritDoc}
     * @see \yii\web\AssetBundle::init()
     */
    public function init()
    {
        // добавляем языковый пакет
        $this->addLangResources(Yii::$app->language);

        parent::init();
    }

    /**
     * Добавляет языковый пакет.
     *
     * @param string $lang
     */
    public function addLangResources(string $lang)
    {
        $langAsset = 'lang/' . $lang . '.js';
        if (!in_array($langAsset, $this->js) && file_exists($this->sourcePath . DIRECTORY_SEPARATOR . $langAsset)) {
            $this->js[] = $langAsset;
        }
    }

    /**
     * Добавляет ресурсы плагинов.
     *
     * @param string[] $plugins
     */
    public function addPluginsResources(array $plugins)
    {
        foreach ($plugins as $plugin) {
            $js = 'plugins/' . $plugin . '/' . $plugin . '.js';
            if (!in_array($js, $this->js) && file_exists($this->sourcePath . DIRECTORY_SEPARATOR . $js)) {
                $this->js[] = $js;
            }

            $css = 'plugins/' . $plugin . '/' . $plugin . '.css';
            if (!in_array($css, $this->css) && file_exists($this->sourcePath . DIRECTORY_SEPARATOR . $css)) {
                $this->css[] = $css;
            }
        }
    }
}
