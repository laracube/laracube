import Vue from 'vue';
import router from '@/router';
require('@/util/axios');
import vuetify from '@/plugins/vuetify';
import Toasted from 'vue-toasted';

window._ = require('lodash');

Vue.use(Toasted, {
    position: 'top-center',
    duration: 2000,
    keepOnHover: true,
});

new Vue({
    router,
    vuetify,
    data: {
        drawer: null,
    },
}).$mount('#laracube');
