const mix = require('laravel-mix');
require('vuetifyjs-mix-extension');

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

mix.webpackConfig(require('./webpack.config'));

mix.js('resources/js/app.js', '../../public/vendor/laracube')
    .vuetify('vuetify-loader')
    .vue()
    .setPublicPath('../../public/vendor/laracube')
    .postCss('resources/css/app.css', '../../public/vendor/laracube')
    .version();
