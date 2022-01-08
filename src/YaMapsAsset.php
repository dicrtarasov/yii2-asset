<?php
/*
 * @copyright 2019-2022 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license proprietary
 * @version 08.01.22 22:11:46
 */

declare(strict_types = 1);
namespace dicr\asset;

use yii\web\AssetBundle;

use function is_array;

/**
 * Яндекс Карты.
 *
 * Для установки параметров в значения по-умолчанию можно наследовать класс.
 *
 * @link https://tech.yandex.ru/maps/doc/jsapi/2.1/dg/concepts/load-docpage/
 * @noinspection PhpUnused
 */
class YaMapsAsset extends AssetBundle
{
    /** @inheritDoc */
    public $baseUrl = 'https://api-maps.yandex.ru';

    /** @var ?string загружаемая версия */
    public ?string $version = '2.1';

    /** @var ?string ключ API */
    public ?string $apikey = null;

    /** @var ?string язык, регион */
    public ?string $lang = 'ru_RU';

    /** @var string порядок координат: широта, долгота */
    public const COORDORDER_LATLONG = 'latlong';

    /** @var string порядок координат: долгота, широта */
    public const COORDORDER_LONGLAT = 'longlat';

    /** @var ?string порядок координат */
    public ?string $coordorder = null;

    /** @var string режим отладочной версии */
    public const MODE_DEBUG = 'debug';

    /** @var string режим релиза */
    public const MODE_RELEASE = 'release';

    /** @var ?string отладочная/релиз-версия */
    public ?string $mode;

    /** @var string[]|string загружаемые модули */
    public string|array|null $load = null;

    /**
     * @inheritDoc
     */
    public function init(): void
    {
        // формируем путь скрипта
        $js = $this->baseUrl;

        // путь
        $path = [];

        if ($this->version !== null) {
            $path[] = $this->version;
        }

        if (! empty($path)) {
            $js .= '/' . implode($path) . '/';
        }

        if (is_array($this->load)) {
            $this->load = implode(',', $this->load);
        }

        // параметры
        $query = [];

        foreach (['apikey', 'lang', 'coordorder', 'mode', 'load'] as $field) {
            $val = trim((string)$this->{$field});
            if ($val !== '') {
                $query[$field] = $val;
            }
        }

        if (! empty($query)) {
            $js .= '?' . http_build_query($query);
        }

        $this->js[] = $js;
    }
}
