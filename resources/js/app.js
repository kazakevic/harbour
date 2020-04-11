window.Vue = require('vue');

import Harbour from './components/Harbour';
Vue.component('harbour', Harbour);
window.app = new Vue(
    {
        data: function () {
                return {};
        },
        methods: {

        },
        mounted: function(){

        }
    }).$mount('#app');
