import Cookies from 'js-cookie'
import {useStore} from "vuex";


export const makeURLQueryString = (url, params) => {
    var esc = encodeURIComponent;
    var query = Object.keys(params)
        .map(k => esc(k) + '=' + esc(params[k]))
        .join('&');
    if (query) {
        url += '?' + query
    }

    return url;
}

export const setToken = (token) => {
    Cookies.set('access_token', token);
}

export const setRefreshToken = (token) => {
    Cookies.set('refresh_token', token);
}

export const getToken = () => {
    return Cookies.get('access_token');
}

export const getRefreshToken = () => {
    return Cookies.get('refresh_token');
}

export const removeToken = () => {
    Cookies.remove('access_token');
    //Cookies.remove('refresh_token');
}


export const getBase64 = (file) => {

    // Returns a promise which gets resolved or rejected based on the reader events
    return new Promise((resolve, reject) => {
        const reader = new FileReader();

        if(file){
            var byte = file.size;
            var mb = byte/(1024*1024);
            if(mb > 1){

                return reject('The image must be less or equal 1MB.');
            }


            // Sets up even listeners BEFORE you call reader.readAsDataURL
            reader.onload = function () {
                const result = reader.result
                return resolve(result);
            };

            reader.onerror = function (error) {
                return reject(error);
            };
            // Calls reader function
            reader.readAsDataURL(file);
        }

    })
}


export const urlOrganize = (path) =>{
    return path.replace(/\\/g, "/")
}

export const formData = (data) =>{

    let form_data = new FormData();

    for (let key in data ) {

        if(key == 'images'){
            for(let key1 in data[key]){
                form_data.append(`images[${key1}]`, data[key][key1]);
            }
        }else {
            form_data.append(key, data[key]);
        }
    }

    return form_data
}

export const getStore = (store)=>{
    return useStore().getters[store];
}


