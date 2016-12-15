var gulp = require('gulp');
const elixir = require('laravel-elixir');


require('laravel-elixir-vue-2');
require('json-loader');

gulp.task('initAdmin', function () {
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
gulp.task('initUser', function () {
    elixir(function (mix) {
        mix.styles([
            'bootstrap.css',
            'animate.css',
            'style.css',
        ], 'public/css/home.css');

        // mix.scripts([
        //     'baseJS/jquery.js',
        //     'baseJS/bootstrap.js',
        //     'baseJS/app.js',
        // ], 'public/js/app.js');
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
    mix.webpack('appJS/category.js');
    mix.webpack('appJS/feedback.js');
    mix.webpack('appJS/post.js');
    // mix.webpack('appJS/login.js');

    // mix.scripts([
    //     'baseJS/jquery.js',
    //     'baseJS/easing.js.js',
    //     'baseJS/move-top.js',
    // ], 'public/js/application.js');
    // mix.webpack('user/contact.js');
});
