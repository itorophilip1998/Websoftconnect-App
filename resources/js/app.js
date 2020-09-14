require('./bootstrap');
import router from './router';
import store from './store';
import fontawesome from '../../node_modules/font-awesome/css/font-awesome.min.css';
window.Vue = require('vue');
Vue.prototype.$baseUrl='http://localhost:8000'
import FlashMessage from '@smartweb/vue-flash-message';
Vue.use(FlashMessage);

import VueCountryCode from 'vue-country-region-select'
Vue.use(VueCountryCode)

// Mainapp
Vue.component('main-app', require('./components/Mainapp.vue').default);


// Vue.filter
const app = new Vue({
    el: '#app',
    fontawesome,
    router,
    store

});
