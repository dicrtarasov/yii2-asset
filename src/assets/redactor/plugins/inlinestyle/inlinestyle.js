/*
 * @copyright 2019-2019 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license proprietary
 * @version 30.04.19 02:39:05
 */

(function ($R) {
    $R.add('plugin', 'inlinestyle', {
        translations: {
            en: {
                "style": "Style"
            }
        },
        init: function (app) {
            this.app = app;
            this.lang = app.lang;
            this.toolbar = app.toolbar;

            // local
            this.styles = {
                "marked": {
                    title: "Marked",
                    args: 'mark'
                },
                "code": {
                    title: "Code",
                    args: 'code'
                },
                "variable": {
                    title: "Variable",
                    args: 'var'
                },
                "shortcut": {
                    title: "Shortcut",
                    args: 'kbd'
                },
                "sup": {
                    title: "Superscript",
                    args: 'sup'
                },
                "sub": {
                    title: "Subscript",
                    args: 'sub'
                }
            };
        },
        start: function () {
            var dropdown = {};
            for (var key in this.styles) {
                var style = this.styles[key];
                dropdown[key] = {
                    title: style.title,
                    api: 'module.inline.format',
                    args: style.args
                };
            }

            var $button = this.toolbar.addButtonAfter('format', 'inline', {title: this.lang.get('style')});

            $button.setIcon('<i class="re-icon-inline"></i>');
            $button.setDropdown(dropdown);
        }
    });
})(Redactor);
