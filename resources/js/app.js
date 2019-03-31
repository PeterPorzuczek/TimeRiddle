window.Vue = require('vue');

require('./assets/styles/tailwind/tailwind-compiled.css');

Vue.mixin(require('./components/mixins/colorSchemeMixin.js').default);
Vue.component('board', require('./components/Board.vue').default);

var app = new Vue({
    el: '#app'
  });
