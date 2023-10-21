import { createRouter, createWebHistory } from 'vue-router'
import routes from "./routes";
import {getToken} from "@/Helper";

const router = createRouter({
    history: createWebHistory(),
    routes:routes,
    linkActiveClass: "active-link"
})

// Auth
function isLoggedIn() {
    return getToken() //store.getters['auth/isAuthenticated'];
}

function isNotPermitted() {
    return store.getters['auth/isNotPermitted'];
}

function isRoutePermitted(route_name) {
    return true;
}

router.beforeEach((to, from, next) => {

    /*
    * if requireAuth = true, auth = false => next({name:"Login"})
    * if requireAuth = true, auth = true => next()
    * if requireAuth = false, auth = false => next()
    * if requireAuth = false, auth = true => next({name:"dashboard"})
    * */
    const isRequireAuth = to.matched.some(record => record.meta.requiresAuth);

    if (isRequireAuth && !isLoggedIn()) {
        next({name:"Login"})
    }else if((isRequireAuth && isLoggedIn()) || (!isRequireAuth && !isLoggedIn())){
        next()
    }else {
        next({name:"dashboard"})
    }

})

export default router

