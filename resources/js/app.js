
require('./bootstrap');

window.Vue = require('vue');
window.axios = require('axios');

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('users', require('./components/Users.vue').default);
Vue.component('user-create', require('./components/Create.vue').default);
Vue.component('user-edit', require('./components/Edit.vue').default);

const app = new Vue({
    el: '#app'
});
