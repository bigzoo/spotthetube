'use strict';
require('./bootstrap');
window.Vue = require('vue');

import Vuelidate from 'vuelidate'

Vue.component('magic', require('./components/Magic.vue'));

// Vuelidate for validations
Vue.use(Vuelidate);

const app = new Vue({
    el: '#app'
});

// Initialize tooltips
$('[data-toggle="tooltip"]').tooltip()