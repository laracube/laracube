export default {
    namespaced: true,
    state: {
        cancelTokens: [],
    },
    getters: {
        cancelTokens(state) {
            return state.cancelTokens;
        },
    },
    mutations: {
        ADD_CANCEL_TOKEN(state, token) {
            state.cancelTokens.push(token);
        },
        CLEAR_CANCEL_TOKENS(state) {
            state.cancelTokens = [];
        },
    },
    actions: {
        CANCEL_PENDING_REQUESTS(context) {
            context.state.cancelTokens.forEach((request, i) => {
                if (request.cancel) {
                    request.cancel();
                }
            });
            context.commit('CLEAR_CANCEL_TOKENS');
        },
    },
};
