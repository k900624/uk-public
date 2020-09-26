const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
    .webpackConfig({
        // module: {
        //     rules: [
        //         {
        //             test: /\.js?$/,
        //             //exclude: /(node_modules\/(?!(dom7|swiper)\/).*|bower_components)/,
        //             //loader: 'babel-loader' + mix.babelConfig()
        //             use: [
        //                 {
        //                     loader: 'babel-loader',
        //                     options: mix.config.babel()
        //                 }
        //             ]
        //         }
        //     ]
        // },
        resolve: {
            alias: {
                '@': path.resolve(__dirname, 'resources/assets/js'),
                '~': path.resolve(__dirname, 'resources/assets/sass'),
                '@app': path.resolve(__dirname, 'resources/assets/js/app'),
                '@components': path.resolve(__dirname, 'resources/assets/js/app/components'),
                '@pages': path.resolve(__dirname, 'resources/assets/js/app/pages')
            }
        }
    })

    .autoload({
        jquery: [
            '$', 'window.jQuery', 'jQuery', 'jquery',
            'bootstrap'
        ],
        'popper.js': ['Popper'],
    })

    // public
    .sass('resources/assets/sass/app/app.sass', 'public/css/app.min.css')
    // .sass('resources/assets/sass/app/modules/articles.sass', 'public/css/modules/articles.min.css')
    // .sass('resources/assets/sass/app/modules/errors.sass', 'public/css/modules/errors.min.css')
    // .sass('resources/assets/sass/app/modules/faq.sass', 'public/css/modules/faq.min.css')
    // .sass('resources/assets/sass/app/modules/home.sass', 'public/css/modules/home.min.css')
    .sass('resources/assets/sass/app/modules/login.sass', 'public/css/modules/login.min.css')
    // .sass('resources/assets/sass/app/modules/search.sass', 'public/css/modules/search.min.css')
    // .sass('resources/assets/sass/app/modules/users.sass', 'public/css/modules/users.min.css')
    .styles([
        'node_modules/bootstrap/dist/css/bootstrap.min.css',
        'resources/assets/vendor/fonts/font-awesome/css/font-awesome.css',
        'resources/assets/vendor/animate.css/animate.min.css',
        'resources/assets/vendor/hamburgers/dist/hamburgers.min.css',
        // 'resources/assets/vendor/messenger/build/css/messenger.css',
        // 'resources/assets/vendor/messenger/build/css/messenger-theme-air.css',
        // 'resources/assets/vendor/jquery-star-rating/min/rating.css',
        // 'resources/assets/vendor/jquery.slick/slick.css',
    ], 'public/css/vendor.min.css')
    // .scripts([
    //     // 'resources/assets/js/app.js',
    //     // 'resources/assets/js/common.js',
    //     'resources/assets/js/functions.js',
    //     'resources/assets/js/helpers.js',
    //     // 'resources/assets/js/plugins.js',
    //     // 'resources/assets/js/respond.js'
    // ], 'public/js/app.min.js')
    .js(
        'resources/assets/js/app/api.js',
        'public/js/api.min.js'
    )
    // .js(
    //     'resources/assets/js/route.js',
    //     'public/js/route.min.js'
    // )
    // .scripts([
    //     'resources/assets/vendor/modernizr-3.5.0.min.js',
    //     'node_modules/jquery/dist/jquery.min.js',
    //     // 'node_modules/popper.js/dist/umd/popper.min.js',
    //     // 'node_modules/bootstrap/dist/js/bootstrap.min.js',
    //     // 'resources/assets/vendor/jquery.cookie/jquery.cookie.js',
    //     // 'resources/assets/vendor/jquery.validation/jquery.validate.min.js',
    //     // 'resources/assets/vendor/jquery.validation/additional-methods.min.js',
    //     // 'resources/assets/vendor/jquery.validation/localization/messages_ru.js',
    //     'resources/assets/vendor/messenger/build/js/messenger.min.js',
    //     'resources/assets/vendor/messenger/build/js/messenger-theme-flat.js',
    //     // 'resources/assets/vendor/jquery-star-rating/min/rating.js',
    //     // 'node_modules/moment/min/moment.min.js',
    // ], 'public/js/vendor.min.js')

    // admin
    .sass('resources/assets/sass/admin/app.sass', 'public/css/admin/app.min.css')
    .sass('resources/assets/sass/admin/tinymce.sass', 'public/css/admin/tinymce.min.css')
    .styles([
        'resources/assets/vendor/bootstrap/css/bootstrap.min.css',
        'resources/assets/vendor/fonts/font-awesome/css/font-awesome.css',
        'resources/assets/vendor/animate.css/animate.min.css',
        'resources/assets/vendor/hamburgers/dist/hamburgers.min.css',
        'resources/assets/vendor/messenger/build/css/messenger.css',
        'resources/assets/vendor/messenger/build/css/messenger-theme-air.css',
    ], 'public/css/admin/vendor.min.css')
    .scripts([
        'resources/assets/js/admin/app.js',
        'resources/assets/js/admin/common.js',
        'resources/assets/js/admin/functions.js',
        'resources/assets/js/helpers.js',
        'resources/assets/js/admin/plugins.js',
        'resources/assets/js/admin/respond.js'
    ], 'public/js/admin/app.min.js')
    .scripts([
        'resources/assets/vendor/modernizr-3.5.0.min.js',
        'resources/assets/vendor/jquery.min.js',
        'resources/assets/vendor/bootstrap/js/bootstrap.min.js',
        'resources/assets/vendor/jquery.cookie/jquery.cookie.js',
        'resources/assets/vendor/jquery.slimscroll/jquery.slimscroll.js',
        'resources/assets/vendor/jquery.inputmask/js/jquery.inputmask.js',
        'resources/assets/vendor/jquery.inputmask/js/jquery.inputmask.phone.extensions.js',
        'resources/assets/vendor/jquery.inputmask/js/jquery.inputmask.date.extensions.js',
        'resources/assets/vendor/jquery.validation/jquery.validate.min.js',
        'resources/assets/vendor/jquery.validation/additional-methods.min.js',
        'resources/assets/vendor/jquery.validation/localization/messages_ru.js',
        'resources/assets/vendor/widgster/widgster.js',
        'resources/assets/vendor/jquery.timeago/jquery.timeago.js',
        'resources/assets/vendor/jquery.timeago/locales/jquery.timeago.ru.js',
        'resources/assets/vendor/messenger/build/js/messenger.min.js',
        'resources/assets/vendor/messenger/build/js/messenger-theme-flat.js'
    ], 'public/js/admin/vendor.min.js')

    .options({
        processCssUrls: false,
        postCss: [
            require('css-mqpacker')
        ]
    })

    .version();
