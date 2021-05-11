/*
 * @copyright 2019-2021 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license proprietary
 * @version 11.05.21 05:49:29
 */

(function (window, $) {
    "use strict";

    /**
     * Класс состояния приложения.
     * Для совместного отслеживания изменений разными компонентами.
     *
     * @constructor
     */
    function State()
    {
        const self = this;

        // данные состояния
        self.data = {};

        /**
         * Обновление данных.
         *
         * @param {object} data
         */
        self.update = function (data) {
            const updates = {};

            Object.keys(data).forEach(function (key) {
                if (!self.data.hasOwnProperty(key) || self.data[key] !== data[key]) {
                    self.data[key] = data[key];
                    updates[key] = data[key];
                }
            });

            if (Object.keys(updates).length > 0) {
                console.debug('updates: ', updates);
                $(self).triggerHandler('change', updates);
            }
        };
    }

    window.app = window.app || {};
    window.app.state = new State();
})(window, jQuery);
