var gulp = require('gulp');
const elixir = require('laravel-elixir');


require('laravel-elixir-vue-2');
require('json-loader');

gulp.task('init', function () {
    elixir(function (mix) {
        mix.styles([
            'font-awesome.css',
            'animate.css',
            'bootstrap.css',
            'AdminLTE.css',
            'all-skins.css',
        ], 'public/css/app.css');

        mix.scripts([
            'baseJS/jquery.js',
            'baseJS/bootstrap.js',
            'baseJS/app.js',
        ], 'public/js/app.js');
    });
});

elixir(function (mix) {
    // mix.styles([
    //     'font-awesome.css',
    //     'animate.css',
    //     'bootstrap.css',
    //     'AdminLTE.css',
    //     'all-skins.css',
    // ], 'public/css/app.css');
    // mix.webpack('appJS/category.js');
    mix.webpack('appJS/post.js');
    // mix.webpack('appJS/login.js');
});
