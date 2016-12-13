window._ = require('lodash');
window.Vue = require('vue');
require('vue-resource');

var config = require('json!./appJS/config.json');
Vue.http.interceptors.push((request, next) => {
    request.headers.set('X-CSRF-TOKEN', Laravel.csrfToken);

    next();
});

import VueProgressBar from 'vue-progressbar';
Vue.use(VueProgressBar, config.vueProgress);

import VueTimeago from 'vue-timeago'

Vue.use(VueTimeago, config.vueTimeago);

import LaravelValidator from 'vue-laravel-validator';
Vue.use(LaravelValidator);

//notify plugin
require('noty');


