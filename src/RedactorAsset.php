<?php
namespace dicr\asset;

use yii\web\AssetBundle;

/**
 * Ресурсы редактора.
 *
 * @author Nghia Nguyen <yiidevelop@hotmail.com>
 * @author Igor (Dicr) Tarasov <develop@dicr.org>
 * @since 2.0
 * @version 2019
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

    /**
     * {@inheritDoc}
     * @see \yii\web\AssetBundle::init()
     */
    public function init()
    {
        // добавляем языковый пакет
        $this->addLangResources(\Yii::$app->language);

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
