import { createApp } from 'vue'
import App from '@/App.vue'
import router from '@/router'
import store from "@/store";
import {getToken} from "@/Helper";
import Api from "@/Api/auth.js";
import {useStore} from "vuex";



//app.prototype.global_contsant = GLOBAL_CONSTANT;

const token = getToken();
/*const eventsHub = new Vue();
const inactiveTime = 100 // min
app.use(IdleVue, {
    eventEmitter: eventsHub,
    store,
    idleTime: 60000 * inactiveTime,
    startAtIdle: false
});*/

const main = () => {
    const app = createApp(App)
    app.config.productionTip = false
    //app.config.globalProperties.$global_contsant = GLOBAL_CONSTANT;

    app.use(router)
    app.use(store)

    app.mount('#app')
}



if (token) {
    //const store1 = useStore()
    Api.getAuthData().then((data) => {
        console.log('data',data.data)
        if(data?.data?.data) {
            store.dispatch('auth/setAuth', data.data.data)
        }
        main();
    })
} else {
    main();
}


