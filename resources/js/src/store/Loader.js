export default {
    namespaced: true,
    state: {
        status: false
    },
    getters: {
        getLoaderStatus : (state) => {
            return state.status;
        }
    },
    mutations: {
        SET_LOADER : (state, payload) => {
            state.status = payload;

        },
        STOP_LOADER : (state, payload) => {
            state.status = payload;

        }
    },
    actions: {
        startLoading: ({ commit }) => {
            commit('SET_LOADER', true);
        },

        stopLoading: ({ commit }) => {
            commit('STOP_LOADER', false);
        }
    }
}
