/**
 * Created by huy on 08/12/2016.
 */
require('../bootstrap');
import VueRouter from 'vue-router'
var urlApi = '/api/feedback';
var notify = {
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
    }
};
Vue.use(VueRouter)
var router = new VueRouter({
    routes: [
        {path: '/', name: 'list', component: require('../components/feedback/list.vue')},
        {path: '/view/:id', name: 'view', component: require('../components/feedback/view.vue')},
    ]
});
var vm = new Vue({
    router,
    data: {
        apiUrl: 'api/feedback',
    },
    methods: {
        notifySuccess: function (text) {
            var n = notify;
            n.text = '<i class="fa fa-check" aria-hidden="true"></i> <strong>' + text + '</strong>';
            n.type = 'success';
            noty(n);
        },
        notifyError: function (text) {
            var n = notify;
            n.text = '<i class="fa fa-times" aria-hidden="true"></i> <strong>' + text + '</strong>';
            n.type = 'error';
            noty(n);
        }
    }
}).$mount('#app');