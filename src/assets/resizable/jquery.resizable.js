/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license proprietary
 * @version 26.07.20 11:27:39
 */

(function (window, $) {
    'use strict';

    /**
     * Resizable.
     *
     * @param {HTMLElement} target
     * @param {object} options
     * @constructor
     */
    function Resizable(target, options)
    {
        const self = this;

        /**
         * Отмена события.
         *
         * @param e
         */
        self.prevent = function (e) {
            e.stopPropagation();
            e.preventDefault();
        };

        /**
         * @param e
         * @returns {{x: number, width: number, y: number, height: number}}
         */
        self.getMousePos = function (e) {
            const pos = {
                x: 0,
                y: 0,
                width: 0,
                height: 0
            };

            if (typeof e.clientX === "number") {
                pos.x = e.clientX;
                pos.y = e.clientY;
            } else if (e.originalEvent.touches) {
                pos.x = e.originalEvent.touches[0].clientX;
                pos.y = e.originalEvent.touches[0].clientY;
            }

            return pos;
        };

        /**
         * @param e
         */
        self.doDrag = function (e) {
            // если прошлое событие еще не обработано, то сохраняем и выходим
            if (self.doDrag.lastEvent) {
                self.doDrag.lastEvent = e;
                return;
            }

            // сохраняем новое значение для обработки
            self.doDrag.lastEvent = e;

            // планируем обработку
            window.requestAnimationFrame(function () {
                // если нет необработанных событий, то выходим
                if (!self.doDrag.lastEvent) {
                    return;
                }

                const e = self.doDrag.lastEvent;

                // очищаем необработанные события
                self.doDrag.lastEvent = null;

                const pos = self.getMousePos(e);
                const css = {};

                if (self.options.resizeWidth) {
                    // noinspection NestedAssignmentJS,JSUnusedGlobalSymbols,AssignmentResultUsedJS
                    css.width = css.minWidth = css.maxWidth = self.startPos.width + pos.x - self.startPos.x;
                }

                if (self.options.resizeHeight) {
                    // noinspection NestedAssignmentJS,JSUnusedGlobalSymbols,AssignmentResultUsedJS
                    css.height = css.minHeight = css.maxHeight = self.startPos.height + pos.y - self.startPos.y;
                }

                if (Object.keys(css).length > 0) {
                    self.dom.css(css);
                }

                // обработчик пользователя
                if (self.options.onDrag) {
                    self.options.onDrag(e, self.dom, self.options);
                }
            });
        };

        /**
         * @param e
         */
        self.startDragging = function (e) {
            self.startPos = self.getMousePos(e);
            self.startPos.width = Number(self.dom.outerWidth());
            self.startPos.height = Number(self.dom.outerHeight());

            if (self.options.onDragStart && self.options.onDragStart(e, self.dom, self.options) === false) {
                return;
            }

            self.startTransition = self.dom.css("transition");
            self.dom.css("transition", "none");

            $(window.document).on('mousemove.rsz', self.doDrag);
            $(window.document).on('mouseup.rsz', self.stopDragging);

            if (window.Touch || navigator.maxTouchPoints) {
                $(window.document).on('touchmove.rsz', self.doDrag);
                $(window.document).on('touchend.rsz', self.stopDragging);
            }

            // noinspection JSCheckFunctionSignatures
            $(window.document).on('selectstart.rsz', self.prevent); // disable selection
        };

        /**
         * @param e
         * @return {boolean}
         */
        self.stopDragging = function (e) {
            self.prevent(e);

            $(window.document).off('.rsz');

            // reset changed values
            self.dom.css("transition", self.startTransition);

            if (self.options.onDragEnd) {
                self.options.onDragEnd(e, self.dom, self.options);
            }

            return false;
        };

        self.options = {
            /** @var {HTMLElement|null} selector for handle that starts dragging */
            handleSelector: null,

            /** @var {boolean} resize the width */
            resizeWidth: true,

            /** @var {boolean} resize the height */
            resizeHeight: true,

            /** @var {Function|null} hook into start drag operation (event passed) */
            onDragStart: null,

            /** @var {Function|null} hook into stop drag operation (event passed) */
            onDragEnd: null,

            /** @var {Function|null} hook into each drag operation (event passed) */
            onDrag: null,

            /** @var {boolean} disable touch-action on $handle, prevents browser level actions like forward back gestures */
            touchActionNone: true
        };

        if (typeof options === "object") {
            self.options = $.extend(self.options, options);
        }

        /** @var начальная позиция и размеры перемещения */
        self.startPos = {
            x: 0,
            y: 0,
            width: 0,
            height: 0,
        };

        /** @var {string} */
        self.startTransition = undefined;

        /** @var {JQuery} */
        self.dom = $(target);

        /** @var {JQuery} */
        self.dom.handle = self.options.handleSelector ? $(self.options.handleSelector) : self.dom;

        if (self.options.touchActionNone) {
            self.dom.handle.css("touch-action", "none");
        }

        self.dom.addClass("resizable");
        self.dom.handle.on('mousedown touchstart', self.startDragging);
    }


    // noinspection JSValidateTypes

    /**
     * Плагин jQuery.
     *
     * @param {object} options
     * @returns {JQuery}
     */
    $.fn.resizable = function (options) {
        return this.each(function () {
            $(this).data('widget', new Resizable(this, options));
        });
    };
})(window, jQuery);
