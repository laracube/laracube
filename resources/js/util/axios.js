import store from '@/store';

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.axios.interceptors.request.use(
    function (config) {
        let source = window.axios.CancelToken.source();
        config.cancelToken = source.token;
        store.commit('axios/ADD_CANCEL_TOKEN', source);
        return config;
    },
    function (error) {
        return Promise.reject(error);
    },
);
