import Vue from 'vue';
import Vuex from 'vuex';
import axios from '@/store/modules/axios';
import filters from '@/store/modules/filters';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        axios,
        filters,
    },
});
