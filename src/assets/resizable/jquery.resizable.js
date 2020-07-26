/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license proprietary
 * @version 26.07.20 11:02:59
 */

(function (window, $) {
    'use strict';

    /* Override jQuery-UI Resizable
    if (typeof($.fn.resizable) === 'function') {
        return;
    }
    */

    $.fn.resizable = function (options) {
        let opt = {
            // selector for handle that starts dragging
            handleSelector: null,
            // resize the width
            resizeWidth: true,
            // resize the height
            resizeHeight: true,
            // hook into start drag operation (event passed)
            onDragStart: null,
            // hook into stop drag operation (event passed)
            onDragEnd: null,
            // hook into each drag operation (event passed)
            onDrag: null,
            // disable touch-action on $handle
            // prevents browser level actions like forward back gestures
            touchActionNone: true
        };

        if (typeof options === "object") {
            opt = $.extend(opt, options);
        }

        return this.each(function () {
            let startPos, startTransition;

            const $el = $(this);
            const $handle = opt.handleSelector ? $(opt.handleSelector) : $el;

            if (opt.touchActionNone) {
                $handle.css("touch-action", "none");
            }

            $el.addClass("resizable");
            // noinspection JSCheckFunctionSignatures
            $handle.on('mousedown.rsz touchstart.rsz', startDragging);

            /**
             * Отмена события.
             *
             * @param e
             */
            function prevent(e)
            {
                e.stopPropagation();
                e.preventDefault();
            }

            function startDragging(e)
            {
                startPos = getMousePos(e);
                startPos.width = Number($el.outerWidth());
                startPos.height = Number($el.outerHeight());

                if (opt.onDragStart && opt.onDragStart(e, $el, opt) === false) {
                    return;
                }

                startTransition = $el.css("transition");
                $el.css("transition", "none");

                opt.dragFunc = doDrag;

                // noinspection JSCheckFunctionSignatures
                $(window.document).on('mousemove.rsz', opt.dragFunc);
                $(window.document).on('mouseup.rsz', stopDragging);

                if (window.Touch || navigator.maxTouchPoints) {
                    $(window.document).on('touchmove.rsz', opt.dragFunc);
                    $(window.document).on('touchend.rsz', stopDragging);
                }

                $(window.document).on('selectstart.rsz', prevent); // disable selection
            }

            function doDrag(e)
            {
                // если прошлое событие еще не обработано, то сохраняем и выходим
                if (doDrag.e) {
                    doDrag.e = e;
                    return;
                }

                // сохраняем новое значение для обработки
                doDrag.e = e;

                // планируем обработку
                window.requestAnimationFrame(function () {
                    // если нет необработанных событий, то выходим
                    const e = doDrag.e || null;
                    if (!e) {
                        return;
                    }

                    // очищаем необработанные события
                    doDrag.e = null;

                    const pos = getMousePos(e);
                    const css = {};

                    if (opt.resizeWidth) {
                        // noinspection NestedAssignmentJS,JSUnusedGlobalSymbols,AssignmentResultUsedJS
                        css.width = css.minWidth = css.maxWidth = startPos.width + pos.x - startPos.x;
                    }

                    if (opt.resizeHeight) {
                        // noinspection NestedAssignmentJS,AssignmentResultUsedJS,JSUnusedGlobalSymbols
                        css.height = css.minHeight = css.maxHeight = startPos.height + pos.y - startPos.y;
                    }

                    if (Object.keys(css).length > 0) {
                        $el.css(css);
                    }

                    // обработчик пользователя
                    if (opt.onDrag) {
                        opt.onDrag(e, $el, opt);
                    }
                });
            }

            function stopDragging(e)
            {
                e.stopPropagation();
                e.preventDefault();

                $(window.document).off('.rsz');

                // reset changed values
                $el.css("transition", startTransition);

                if (opt.onDragEnd) {
                    opt.onDragEnd(e, $el, opt);
                }

                return false;
            }

            function getMousePos(e)
            {
                const pos = {x: 0, y: 0, width: 0, height: 0};

                if (typeof e.clientX === "number") {
                    pos.x = e.clientX;
                    pos.y = e.clientY;
                } else if (e.originalEvent.touches) {
                    pos.x = e.originalEvent.touches[0].clientX;
                    pos.y = e.originalEvent.touches[0].clientY;
                } else {
                    return null;
                }

                return pos;
            }
        });
    };
})(window, jQuery);
