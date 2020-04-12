window.Vue = require('vue');

import Harbour from './components/Harbour';
import { LMap, LTileLayer, LMarker, LTooltip } from 'vue2-leaflet';
import 'leaflet/dist/leaflet.css';
Vue.component('l-map', LMap);
Vue.component('l-tile-layer', LTileLayer);
Vue.component('l-marker', LMarker);


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
