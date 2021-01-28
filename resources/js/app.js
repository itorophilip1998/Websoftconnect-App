require('./bootstrap');
import router from './router';
import store from './store';
import fontawesome from '../../node_modules/font-awesome/css/font-awesome.min.css';
window.Vue = require('vue');
Vue.prototype.$baseUrl='http://localhost:8000'
import FlashMessage from '@smartweb/vue-flash-message';
Vue.use(FlashMessage);

import vueCountryRegionSelect from 'vue-country-region-select'
Vue.use(vueCountryRegionSelect)
import VueChatScroll from 'vue-chat-scroll'
Vue.use(VueChatScroll)


import AudioRecorder from 'vue-audio-recorder'
Vue.use(AudioRecorder)
import VueRecord from '@codekraft-studio/vue-record' 
Vue.use(VueRecord)
// Mainapp
Vue.component('main-app', require('./components/Mainapp.vue').default);


// Vue.filter
const app = new Vue({
    el: '#app',
    fontawesome,
    router,
    store

});
