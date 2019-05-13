/// <reference path="jquery.js" />
/*
jquery-watcher
Version 0.13 - 12/22/2015
© 2015 Rick Strahl, West Wind Technologies
www.west-wind.com
Licensed under MIT License
*/
(function($, undefined) {
    /* Override jQuery-UI Resizable
	if (typeof($.fn.resizable) == 'function') {
        return;
	}
	*/

    $.fn.resizable = function fnResizable(options) {
        var opt = {
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

        if (typeof options == "object") {
            opt = $.extend(opt, options);
        }

        return this.each(function () {
            var startPos, startTransition;

            var $el = $(this);
            var $handle = opt.handleSelector ? $(opt.handleSelector) : $el;

            if (opt.touchActionNone) {
                $handle.css("touch-action", "none");
            }

            $el.addClass("resizable");
            $handle.bind('mousedown.rsz touchstart.rsz', startDragging);

            function noop(e) {
                e.stopPropagation();
                e.preventDefault();
            };

            function startDragging(e) {
                startPos = getMousePos(e);
                startPos.width = parseInt($el.outerWidth(), 10);
                startPos.height = parseInt($el.outerHeight(), 10);

                startTransition = $el.css("transition");
                $el.css("transition", "none");

                if (opt.onDragStart) {
                    if (opt.onDragStart(e, $el, opt) === false)
                        return;
                }
                opt.dragFunc = doDrag;

                $(document).bind('mousemove.rsz', opt.dragFunc);
                $(document).bind('mouseup.rsz', stopDragging);
                if (window.Touch || navigator.maxTouchPoints) {
                    $(document).bind('touchmove.rsz', opt.dragFunc);
                    $(document).bind('touchend.rsz', stopDragging);
                }

                $(document).bind('selectstart.rsz', noop); // disable selection
            }

            function doDrag(e) {
                var pos = getMousePos(e);

                if (opt.resizeWidth) {
                    var newWidth = startPos.width + pos.x - startPos.x;
                    $el.css({
                    	width: newWidth,
                    	minWidth: newWidth,
                    	maxWidth: newWidth
                    });
                }

                if (opt.resizeHeight) {
                    var newHeight = startPos.height + pos.y - startPos.y;
                    $el.css({
                    	height: newHeight,
                    	minHeight: newHeight,
                    	maxHeight: newHeight
                    });
                }

                if (opt.onDrag)
                    opt.onDrag(e, $el, opt);

                //console.log('dragging', e, pos, newWidth, newHeight);
            }

            function stopDragging(e) {
                e.stopPropagation();
                e.preventDefault();

                $(document).unbind('mousemove.rsz', opt.dragFunc);
                $(document).unbind('mouseup.rsz', stopDragging);

                if (window.Touch || navigator.maxTouchPoints) {
                    $(document).unbind('touchmove.rsz', opt.dragFunc);
                    $(document).unbind('touchend.rsz', stopDragging);
                }

                $(document).unbind('selectstart.rsz', noop);

                // reset changed values
                $el.css("transition", startTransition);

                if (opt.onDragEnd)
                    opt.onDragEnd(e, $el, opt);

                return false;
            }

            function getMousePos(e) {
                var pos = { x: 0, y: 0, width: 0, height: 0 };
                if (typeof e.clientX === "number") {
                    pos.x = e.clientX;
                    pos.y = e.clientY;
                } else if (e.originalEvent.touches) {
                    pos.x = e.originalEvent.touches[0].clientX;
                    pos.y = e.originalEvent.touches[0].clientY;
                } else
                    return null;

                return pos;
            }
        });
    };
})(jQuery,undefined);