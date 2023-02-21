import Vue from "vue";

// @ts-ignore
import VCalendar from 'v-calendar';

require('./bootstrap');

window.Vue = require('vue').default;

// @ts-ignore
const files = require.context('./', true, /\.vue$/i)
// @ts-ignore
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.use(VCalendar);

const app = new Vue({
    el: '#app',
});
