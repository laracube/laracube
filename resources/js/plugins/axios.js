import ax from 'axios';
import store from '@/store';

ax.interceptors.request.use(
    function (config) {
        let source = ax.CancelToken.source();
        config.cancelToken = source.token;
        store.commit('axios/ADD_CANCEL_TOKEN', source);
        return config;
    },
    function (error) {
        return Promise.reject(error);
    },
);

export const axios = ax;

export default {
    install(Vue, options) {
        Vue.prototype.$axios = ax;
    },
};
