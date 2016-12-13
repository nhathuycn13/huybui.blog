/**
 * Created by huy on 08/12/2016.
 */

window._ = require('lodash');

import Vue from 'vue';
import VueResource from 'vue-resource';
import LaravelValidator from 'vue-laravel-validator';
require('noty');
Vue.use(VueResource);
Vue.use(LaravelValidator);
import VueProgressBar from 'vue-progressbar';
Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '3px'
});

Vue.http.interceptors.push((request, next) => {
    request.headers.set('X-CSRF-TOKEN', Laravel.csrfToken);
    next();
});

var vm = new Vue({
    el: '#app',
    data(){
        return {
            form: this.$form({
                'email': null,
                'password': null,
            })
        }
    },
    created: function () {
        var pg = this.$Progress;
        pg.start();
        pg.finish();
    },
    methods: {
        login: function () {
            this.$Progress.start();
            var me = this;
            this.form.post('/login').then(function (response) {
                me.$Progress.finish();
                window.location = response.body;
            }, function (response) {
                me.$Progress.fail();
                if (response.status === 422){
                    var errs = me.form.$errors;
                    if (errs.has('email')){
                        me.notifyMe(errs.get('email')[0]);
                    }
                    if (errs.has('password')){
                        me.notifyMe(errs.get('password')[0]);
                    }
                    if (response.body !== '' && (typeof response.body != 'object')){
                        me.notifyMe(response.body);
                    }
                }
            })
        },
        notifyMe: function (text) {
            noty({
                dismissQueue: true,
                layout      : 'bottomRight',
                closeWith   : ['click', 'hover'],
                theme       : 'relax',
                maxVisible  : 10,
                timeout: 100,
                animation   : {
                    open  : 'animated lightSpeedIn',
                    close : 'animated lightSpeedOut',
                    easing: 'swing',
                    speed : 500
                },
                'text': '<i class="fa fa-times" aria-hidden="true"></i> <strong>'+ text + '</strong>',
                'type': 'error',
            });
        },
    }
});