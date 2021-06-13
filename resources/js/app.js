/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import Vue from 'vue';
import App from './vue/app';
import router from './routers'
import store from './store/index'
import Axios from 'axios'

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

Vue.prototype.$http = Axios;
const token = localStorage.getItem('token')
if (token) {
  Vue.prototype.$http.defaults.headers.common['Authorization'] = `Bearer ${token}`
}

Vue.use(VueSweetalert2);

//Event Bus
// const EventBus = new Vue();
// export default EventBus;




new Vue({
    router,
    store,
    render: h=>h(App),
}).$mount('#app')



// const app = new Vue({
//     el: '#app',
//     components: {App}
// });
