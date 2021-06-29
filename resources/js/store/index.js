import Vue from 'vue';
import Vuex from 'vuex';
import axios from '@/store/modules/axios';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        axios,
    },
});
