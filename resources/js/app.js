require('./bootstrap');
import router from './router';
import store from './store';
import fontawesome from '../../node_modules/font-awesome/css/font-awesome.min.css';
window.Vue = require('vue');
Vue.prototype.$baseUrl='http://localhost:8000'
import FlashMessage from '@smartweb/vue-flash-message';
Vue.use(FlashMessage);    
// Mainapp
Vue.component('main-app', require('./components/Mainapp.vue').default);
// Auth
Vue.component('main-reset', require('./components/auth/reset.vue').default);
Vue.component('main-register', require('./components/auth/register.vue').default);
Vue.component('main-login', require('./components/auth/login.vue').default);
// Vue.filter
const app = new Vue({
    el: '#app',
    fontawesome,
    router,
    store

});
