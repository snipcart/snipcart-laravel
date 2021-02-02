import Vue from 'vue';
import AsyncComputed from 'vue-async-computed';

import App from './components/app';
import vuetify from './vuetify'

Vue.use(AsyncComputed);

Vue.config.devtools = true;


Vue.filter('titleize', function (value) {
    return value.replace(/(?:^|\s|-)\S/g, x => x.toUpperCase());
  })

new Vue({
    render: (h) => h(App),
    el: '#app',
    vuetify: vuetify,
}).$mount('#app');
