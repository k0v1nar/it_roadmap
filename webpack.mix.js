const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.setPublicPath('public/')
    .js('resources/js/app.js', 'js')
    .vue()
    .sass('resources/sass/app.scss', 'css')
    .sourceMaps();

mix.setPublicPath('public/')
    .js('resources/js/app-admin.js', 'js')
    .vue()
    .sass('resources/sass/app-admin.scss', 'css')
    .sourceMaps();