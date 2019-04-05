<?php
namespace app\assets;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

/**
 * Summernote Asset Bundle.
 *
 * @author Igor (Dicr) Tarasov <develop@dicr.org>
 * @version 2019
 */
class SummernoteAsset extends AssetBundle
{
    /** @var array[] конфиг для Bootstrap 3.x */
    const BS3 = [
        'css' => [
            'http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css'
        ],
        'js' => [
            'http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js'
        ],
        'depends' => [
            'yii\bootstrap\BootstrapAsset'
        ]
    ];

    /** @var array[] конфиг для Bootstrap 4.x */
    const BS4 = [
        'css' => [
            'https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.css'
        ],
        'js' => [
            'https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.min.js'
        ],
        'depends' => [
            'yii\bootstrap4\BootstrapAsset'
        ]
    ];

    /** @var string[] зависимости */
    public $depends = [
        JqueryAsset::class,
    ];

    /**
     * {@inheritDoc}
     * @see \yii\web\AssetBundle::init()
     */
    public function init()
    {
        // определяем верси Bootstrap
        if (class_exists('yii\bootstrap4\BootstrapAsset', true)) {
            $this->addResources(self::BS4);
        } else {
            $this->addResources(self::BS3);
        }
    }

    /**
     * Добавляет ресурсы
     *
     * @param array $res
     */
    private function addResources(array $res)
    {
        if (!empty($res['css'])) {
            foreach ($res['css'] as $css) {
                $this->css[] = $css;
            }
        }

        if (!empty($res['js'])) {
            foreach ($res['js'] as $js) {
                $this->js[] = $js;
            }
        }

        if (!empty($res['depends'])) {
            foreach ($res['depends'] as $deps) {
                $this->depends[] = $deps;
            }
        }
    }
}