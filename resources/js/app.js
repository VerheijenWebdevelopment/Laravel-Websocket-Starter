require('./bootstrap');

// Load Vue
window.Vue = require('vue');

// Automatically load all vue components
const files = require.context('./', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Create the Vue.js application
const app = new Vue({
    el: '#app',
});