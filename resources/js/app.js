window.Vue = require('vue');

require('./assets/styles/tailwind/tailwind-compiled.css');

Vue.component('board', require('./components/Board.vue').default);

var app = new Vue({
    el: '#app'
  });
