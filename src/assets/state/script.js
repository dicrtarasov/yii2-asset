/*
 * @copyright 2019-2022 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license proprietary
 * @version 04.01.22 16:15:12
 */

((window, $) => {
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
        self.update = data => {
            const updates = {};

            Object.keys(data).forEach(key => {
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
