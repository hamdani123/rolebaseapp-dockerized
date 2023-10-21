import {useRoute, useRouter} from "vue-router";
import {onMounted, reactive, toRefs} from "vue";
import {setToken} from "@/Helper/index.js";
import Api from "@/Api/auth.js";
import router from "@/router/routes";
import store from "@/store/index.js";
import {useStore} from "vuex";

export const loginPage = ()=>{
    const router = useRouter()
    const store = useStore();
    const state = reactive({
        email: "",
        password: "",
        errors: {}
    })

    state.login = async () => {
        state.errors = {}
        let email = state.email;
        let password = state.password;
        const response = await Api.login({email, password})

        if (response?.data?.status_code == 200) {
            //console.log('ddddd',response.data.data)
            store.dispatch('auth/setAuth',response.data.data)
            await router.push({name:'dashboard'});
        } else {
            if (response?.data) {
                state.errors.message = response?.data?.message;
            }
        }
    }

    return toRefs(state)
}


export const sidebarGenerate = () =>{
    const route = useRoute();
    let sidebar_list = []
    router.map((value)=>{
        if(value.meta?.requiresAuth) {
            value.is_active = false;
            value.children.map((current_sidebar) => {
                current_sidebar.children.some((data)=>{
                    data.is_active = data.name == route.name
                    if(data.is_active) {
                        current_sidebar.is_active = data.is_active;
                    }
                })
            })
            // value.children.is_active = is_active;
            sidebar_list = value.children;
            console.log('state.sidebar_list',sidebar_list)
        }
    })

    return sidebar_list;
}
export const setSideBar = ()=>{
    const state = reactive({
        sidebar_list:[]
    })

    //console.clear()
    //console.log('c route',route.name)
    onMounted(()=>{
        state.sidebar_list = sidebarGenerate()
    })

    return toRefs(state);
}
