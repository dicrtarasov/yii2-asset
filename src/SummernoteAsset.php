<?php
/**
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license proprietary
 * @version 15.06.20 18:06:02
 */

declare(strict_types=1);

namespace dicr\asset;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

/**
 * Summernote Asset Bundle.
 */
class SummernoteAsset extends AssetBundle
{
    /** @var array[] конфиг для Bootstrap 3.x */
    public const BS3 = [
        'css' => [
            'https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.css'
        ],
        'js' => [
            'https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/lang/summernote-ru-RU.min.js'
        ],
        'depends' => [
            'yii\bootstrap\BootstrapAsset'
        ]
    ];

    /** @var array[] конфиг для Bootstrap 4.x */
    public const BS4 = [
        'css' => [
            'https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css'
        ],
        'js' => [
            'https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js'
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
     * @inheritDoc
     */
    public function init()
    {
        // определяем версии Bootstrap
        if (class_exists('yii\bootstrap4\BootstrapAsset')) {
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
