import {setToken} from "@/Helper/index.js";

export default {
    namespaced: true,
    state: {
        auth: {},
        sidebar:[],
        permission_keys:[]
    },
    getters: {
        getAuth : (state) => {
            return state.auth;
        },
        getSideBar: (state) =>{
            return state.sidebar
        }
    },
    mutations: {
        SET_LOGOUT : (state, payload) => {
            state.auth = payload;
        },
        STOP_LOADER : (state, payload) => {
            state.status = payload;

        },
        SET_SIDEBAR: (state, payload)=>{
            state.sidebar = payload;
        },
        SET_AUTH: (state, payload)=>{
            if(payload) {
                state.auth = payload?.user;
                state.sidebar = payload?.sidebar;
                state.permission_keys = payload?.permission_keys;
                if(payload?.access_token) {
                    setToken(payload?.access_token)
                }
            }
        }
    },
    actions: {
        setLogout: ({ commit }) => {
            commit('SET_LOGOUT', true);
        },
        setAuth:({ commit },payload)=>{
            commit('SET_AUTH', payload);
        },

        stopLoading: ({ commit }) => {
            commit('STOP_LOADER', false);
        },
        setSideBar:({ commit },payload)=>{
            commit('SET_SIDEBAR', payload);
        }
    }
}
