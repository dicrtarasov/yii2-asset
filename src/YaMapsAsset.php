<?php
/**
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license proprietary
 * @version 08.07.20 06:15:14
 */

declare(strict_types=1);
namespace dicr\asset;

use yii\web\AssetBundle;
use function is_array;

/**
 * Яндекс Карты.
 *
 * Для установки параметров в значения по-умолчанию можно наследовать класс.
 *
 * @link https://tech.yandex.ru/maps/doc/jsapi/2.1/dg/concepts/load-docpage/
 */
class YaMapsAsset extends AssetBundle
{
    /** @inheritDoc */
    public $baseUrl = 'https://api-maps.yandex.ru';

    /** @var string загружаемая версия */
    public $version = '2.1';

    /** @var string ключ API */
    public $apikey;

    /** @var string язык, регион */
    public $lang = 'ru_RU';

    /** @var string порядок координат: широта, долгота */
    public const COORDORDER_LATLONG = 'latlong';

    /** @var string порядок координат: долгота, широта */
    public const COORDORDER_LONGLAT = 'longlat';

    /** @var string порядок координат */
    public $coordorder;

    /** @var string режим отладочной версии */
    public const MODE_DEBUG = 'debug';

    /** @var string режим релиза */
    public const MODE_RELEASE = 'release';

    /** @var string отладочная/релиз-версия */
    public $mode;

    /** @var string[]|string загружаемые модули */
    public $load;

    /**
     * @inheritDoc
     */
    public function init() : void
    {
        // формируем путь скрипта
        $js = $this->baseUrl;

        // путь
        $path = [];

        $this->version = trim($this->version);
        if (!empty($this->version)) {
            $path[] = $this->version;
        }

        if (!empty($path)) {
            $js .= '/' . implode($path) . '/';
        }

        if (is_array($this->load)) {
            $this->load = implode(',', $this->load);
        }

        // параметры
        $query = [];

        foreach (['apikey', 'lang', 'coordorder', 'mode', 'load'] as $field) {
            $this->{$field} = trim($this->{$field} ?? '');
            if ($this->{$field} !== '') {
                $query[$field] = $this->{$field};
            }
        }

        if (!empty($query)) {
            $js .= '?' . http_build_query($query);
        }

        $this->js[] = $js;
    }
}
