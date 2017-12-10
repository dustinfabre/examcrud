
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Vuetable from 'vuetable-2/src/components/Vuetable';
import VuetablePagination from 'vuetable-2/src/components/VuetablePagination';
import VueRouter from 'vue-router';
Vue.use(VueRouter);
import router from './router';

Vue.component('vue-table', Vuetable);
Vue.component('vuetable-pagination', VuetablePagination);
const app = new Vue({
    el: '#app',
    router
});
