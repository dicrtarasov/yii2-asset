/*
 * @copyright 2019-2019 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license proprietary
 * @version 28.12.18 18:10:02
 */

(function (deparam) {
    "use strict";

    if (typeof require === 'function' && typeof exports === 'object' && typeof module === 'object') {
        try {
            var jquery = require('jquery');
        } catch (e) {
            // noop
        }

        module.exports = deparam(jquery);
    } else if (typeof define === 'function' && define.amd) {
        define(['jquery'], function (jquery) {
            return deparam(jquery);
        });
    } else {
        var global;

        try {
            global = eval('this'); // best cross-browser way to determine global for < ES5
        } catch (e) {
            global = window; // fails only if browser (https://developer.mozilla.org/en-US/docs/Web/Security/CSP/CSP_policy_directives)
        }
        global.deparam = deparam(global.jQuery); // assume jQuery is in global namespace
    }
})(function ($) {
    "use strict";

    var deparam = function (params, coerce) {
        params = !params ? '' : String(params);

        var obj = {};
        var coerceTypes = {'true': !0, 'false': !1, 'null': null};

        // Iterate over all name=value pairs.
        params.replace(/\+/g, ' ').split('&').forEach(function (v) {
            var param = v.split('=');
            var key = decodeURIComponent(param[0]);
            var val;
            var cur = obj;
            var i = 0;

            // If key is more complex than 'foo', like 'a[]' or 'a[b][c]', split it
            // into its component parts.
            var keys = key.split('][');
            var keysLast = keys.length - 1;

            // If the first keys part contains [ and the last ends with ], then []
            // are correctly balanced.
            if (/\[/.test(keys[0]) && /]$/.test(keys[keysLast])) {
                // Remove the trailing ] from the last keys part.
                keys[keysLast] = keys[keysLast].replace(/]$/, '');

                // Split first keys part into two parts on the [ and add them back onto
                // the beginning of the keys array.
                keys = keys.shift().split('[').concat(keys);

                keysLast = keys.length - 1;
            } else {
                // Basic 'foo' style key.
                keysLast = 0;
            }

            // Are we dealing with a name=value pair, or just a name?
            if (param.length === 2) {
                val = decodeURIComponent(param[1]);

                // Coerce values.
                if (coerce) {
                    val = val && !isNaN(val) && ((+val + '') === val) ? +val        // number
                        : val === 'undefined' ? undefined         // undefined
                            : coerceTypes[val] !== undefined ? coerceTypes[val] // true, false, null
                                : val;                                                          // string
                }

                if (keysLast) {
                    // Complex key, build deep object structure based on a few rules:
                    // * The 'cur' pointer starts at the object top-level.
                    // * [] = array push (n is set to array length), [n] = array if n is
                    //   numeric, otherwise object.
                    // * If at the last keys part, set the value.
                    // * For each keys part, if the current level is undefined create an
                    //   object or array based on the type of the next keys part.
                    // * Move the 'cur' pointer to the next level.
                    // * Rinse & repeat.
                    for (; i <= keysLast; i++) {
                        key = keys[i] === '' ? cur.length : keys[i];
                        cur = cur[key] = i < keysLast ? cur[key] || (keys[i + 1] ? {} : []) : val;
                    }

                } else {
                    // Simple key, even simpler rules, since only scalars and shallow
                    // arrays are allowed.

                    if (Object.prototype.toString.call(obj[key]) === '[object Array]') {
                        // val is already an array, so push on the next value.
                        obj[key].push(val);

                    } else if ({}.hasOwnProperty.call(obj, key)) {
                        // val isn't an array, but since a second value has been specified,
                        // convert val into an array.
                        obj[key] = [obj[key], val];

                    } else {
                        // val is a scalar.
                        obj[key] = val;
                    }
                }

            } else if (key) {
                // No value was defined, so set something meaningful.
                obj[key] = coerce ? undefined : '';
            }
        });

        return obj;
    };

    if ($) {
        $.prototype.deparam = $.deparam = deparam;
    }

    return deparam;
});
