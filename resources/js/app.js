import Vue from 'vue';
import AsyncComputed from 'vue-async-computed';

import App from './components/app';
import vuetify from './vuetify'

Vue.use(AsyncComputed);

Vue.config.devtools = true;
const app = new Vue({
    render: (h) => h(App),
    el: '#app',
    vuetify,
});
