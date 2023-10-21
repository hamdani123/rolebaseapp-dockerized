import axios from "axios";
import { getToken, setToken, removeToken } from '@/Helper'

import store from '@/store';
import * as config from '@/config';
import router from '@/router'

export const Api = axios.create({
    baseURL: config.API_BASE_URL
});

const actionScope = `loading`;
let requestsPending = 0;
const req = {
    pending: () => {
        requestsPending++;
        store.dispatch(`${actionScope}/startLoading`);
    },
    done: () => {
        requestsPending--;
        if (requestsPending <= 0) {
            store.dispatch(`${actionScope}/stopLoading`);
        }
    }
};

Api.interceptors.request.use(function(config) {
    req.pending();
    const token = getToken();

    if(token) {
        config.headers['Authorization'] = 'Bearer ' + token;
    }
    if(!config.headers['Content-Type']){
        config.headers['Content-Type'] = 'application/json; charset=utf-8';
    }

    config.headers['Accept'] = 'application/json';
    //config.headers['Content-Type'] = "multipart/form-data"
    console.log('resquest.success', config);
    //console.log('request loader_status', store.getters['loading/getLoaderStatus']);
    //alert(JSON.stringify(config))
    return config;

}, function(error) {
    req.done();
    //console.log('resquest.error', error);
    return Promise.reject(error);
});

Api.interceptors.response.use(
    (response) => {
        req.done();
        console.log('response.success', response.data);
        //alert('success '+JSON.stringify(response))
        if(response.data.status_code === 401){
            //store.dispatch('auth/setLogout');
            removeToken()
            router.push({name:'Login'})
        }
        response.headers['Content-Type'] = "application/json"
        //console.log('response loader_status', store.getters['loading/getLoaderStatus']);
        return response;
    },
    error => {
        req.done();
        alert('error imran '+JSON.stringify(error))
        console.log('resquest.error', error);
        store.dispatch('auth/setLogout');
        router.push({name:'Login'})
        return Promise.reject(error);
        // Reject promise if usual error

        /*
         * When response code is 401, try to refresh the token.
         * Eject the interceptor so it doesn't loop in case
         * token refresh causes the 401 response
         */

        // console.log('sssssssss',error.response.status);


    }
);


export const header = () => {
    let token = getToken();
    let obj = {};

    if (token) {
        obj = {
            'Authorization': 'Bearer ' + token,
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        };
    }

    return obj;
}


export const parameters = (params) => {
    var obj = {};

    if (params) {
        obj['params'] = params;
    }

    return obj;
}
