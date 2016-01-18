var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    /* App files */
    mix.styles([
        '../../../node_modules/bootstrap/dist/css/bootstrap.min.css',
        '../../../node_modules/bootstrap/dist/css/bootstrap-theme.min.css',
        '../../../node_modules/font-awesome/css/font-awesome.min.css',
        '../../../node_modules/select2/dist/css/select2.min.css',
        '../../../node_modules/tablesorter/dist/css/theme.bootstrap.min.css',
        '../../../node_modules/animate.css/animate.min.css',
        '../../../node_modules/sweetalert/dist/sweetalert.css',
        '../../../node_modules/cropper/dist/cropper.min.css',
        '../../../bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css'
    ], 'public/css/app.bundle.css');

    mix.scripts([
        '../../../node_modules/jquery/dist/jquery.min.js',
        '../../../node_modules/vue/dist/vue.min.js',
        '../../../node_modules/bootstrap/dist/js/bootstrap.min.js',
        '../../../node_modules/select2/dist/js/select2.min.js',
        '../../../node_modules/select2/dist/js/i18n/ru.js',
        '../../../node_modules/noty/js/noty/packaged/jquery.noty.packaged.min.js',
        '../../../node_modules/jquery.scrollto/jquery.scrollTo.min.js',
        '../../../node_modules/tablesorter/dist/js/jquery.tablesorter.combined.min.js',
        '../../../node_modules/numeral/min/numeral.min.js',
        '../../../node_modules/numeral/min/languages/ru.min.js',
        '../../../node_modules/sweetalert/dist/sweetalert.min.js',
        '../../../node_modules/jquery-mask-plugin/dist/jquery.mask.min.js',
        '../../../node_modules/jquery.inputmask/dist/jquery.inputmask.bundle.js',
        '../../../node_modules/zxcvbn/dist/zxcvbn.js',
        '../../../node_modules/cropper/dist/cropper.min.js',
        '../../../bower_components/mobile-detect/mobile-detect.min.js',
        '../../../bower_components/moment/min/moment-with-locales.min.js',
        '../../../bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
        '../../../bower_components/jquery-ui/ui/minified/effect.min.js',
        '../../../bower_components/jquery-ui/ui/minified/effect-slide.min.js',
        '../../../bower_components/purl/purl.js',
        '../../../bower_components/scrollup/dist/jquery.scrollUp.min.js'
    ], 'public/js/app.bundle.js');

    mix.copy([
        'node_modules/font-awesome/fonts',
        'node_modules/bootstrap/fonts'
    ], 'public/fonts');







    /* Admin files */
    mix.styles([
        '../../../node_modules/bootstrap/dist/css/bootstrap.min.css',
        '../../../node_modules/bootstrap/dist/css/bootstrap-theme.min.css',
        '../../../node_modules/font-awesome/css/font-awesome.min.css',
        '../../../node_modules/select2/dist/css/select2.min.css',
        '../../../node_modules/tablesorter/dist/css/theme.bootstrap.min.css',
        '../../../node_modules/animate.css/animate.min.css',
        '../../../node_modules/codemirror/lib/codemirror.css',
        '../../../node_modules/codemirror/theme/monokai.css',
        '../../../node_modules/summernote/dist/summernote.css',
        '../../../bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css'
    ], 'public/css/admin.bundle.css');

    mix.scripts([
        '../../../node_modules/jquery/dist/jquery.min.js',
        '../../../node_modules/vue/dist/vue.min.js',
        '../../../node_modules/bootstrap/dist/js/bootstrap.min.js',
        '../../../node_modules/select2/dist/js/select2.min.js',
        '../../../node_modules/select2/dist/js/i18n/ru.js',
        '../../../node_modules/noty/js/noty/packaged/jquery.noty.packaged.min.js',
        '../../../node_modules/tablesorter/dist/js/jquery.tablesorter.combined.min.js',
        '../../../node_modules/tablesorter/dist/js/extras/jquery.tablesorter.pager.min.js',
        '../../../node_modules/codemirror/lib/codemirror.js',
        '../../../node_modules/codemirror/mode/xml/xml.js',
        '../../../node_modules/summernote/dist/summernote.min.js',
        '../../../node_modules/summernote/lang/summernote-ru-RU.js',
        '../../../bower_components/moment/min/moment-with-locales.min.js',
        '../../../bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
        '../../../bower_components/jquery-ui/ui/minified/effect.min.js',
        '../../../bower_components/jquery-ui/ui/minified/effect-slide.min.js'
    ], 'public/js/admin.bundle.js');
});
