/*
 * @copyright 2019-2022 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license proprietary
 * @version 04.01.22 16:05:33
 */

// noinspection ES6ConvertRequireIntoImport
(deparam => {
    "use strict";

    // noinspection JSUnresolvedVariable
    if (typeof require === 'function' && typeof exports === 'object' && typeof module === 'object') {
        let jquery;

        // noinspection UnusedCatchParameterJS
        try {
            // noinspection ES6ConvertVarToLetConst,JSUnresolvedFunction,NpmUsedModulesInstalled
            jquery = require('jquery');
        } catch (e) {
            // noop
        }

        // noinspection JSUnusedGlobalSymbols,JSUnresolvedVariable
        module.exports = deparam(jquery);
    } else {
        // noinspection JSUnresolvedVariable
        if (typeof define === 'function' && define.amd) {
            // noinspection JSUnresolvedFunction
            define(['jquery'], jquery => deparam(jquery));
        } else {
            // noinspection JSUnusedGlobalSymbols
            window.deparam = deparam($); // assume jQuery is in global namespace
        }
    }
})($ => {
    "use strict";

    const deparam = (params, coerce) => {
        // noinspection AssignmentToFunctionParameterJS
        params = params ? String(params) : '';

        const obj = {};
        const coerceTypes = {'true': !0, 'false': !1, 'null': null};

        // Iterate over all name=value pairs.
        // noinspection OverlyComplexFunctionJS
        params.replace(/[+]/g, ' ').split('&').forEach(v => {
            const param = v.split('=');
            let key = decodeURIComponent(param[0]);
            let cur = obj;
            let i = 0;

            // If key is more complex than 'foo', like 'a[]' or 'a[b][c]', split it
            // into its component parts.
            let keys = key.split('][');
            let keysLast = keys.length - 1;

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
                let val = decodeURIComponent(param[1]); // Coerce values.
                if (coerce && val !== undefined && val !== null) {
                    if (val === 'undefined') {
                        val = undefined;
                    } else if (!isNaN(Number(val))) {
                        val = Number(val);
                    } else if (typeof coerceTypes[val] !== 'undefined') {
                        val = coerceTypes[val];
                    }
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
                        // noinspection NestedAssignmentJS,AssignmentResultUsedJS
                        cur = cur[key] = i < keysLast ? (cur[key] || (keys[i + 1] ? {} : [])) : val;
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
        // noinspection JSUnusedGlobalSymbols
        $.prototype.deparam = deparam;
    }

    return deparam;
});
