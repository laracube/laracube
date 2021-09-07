import Vue from 'vue';
import router from '@/router';
import vuetify from '@/plugins/vuetify';
import Toasted from 'vue-toasted';
import VueAxios from '@/plugins/axios';
import store from '@/store';

Vue.use(VueAxios);

Vue.use(Toasted, {
    position: 'top-center',
    duration: 2000,
    keepOnHover: true,
});

new Vue({
    router,
    vuetify,
    store,
    data: {
        drawer: null,
    },
}).$mount('#laracube');
