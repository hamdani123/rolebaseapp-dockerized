<template>
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <li class="nav-item nav-profile">
                <a href="#" class="nav-link">
                    <div class="profile-image">
                        <img class="img-xs rounded-circle" src="/images/faces/face8.jpg" alt="profile image">
                        <div class="dot-indicator bg-success"></div>
                    </div>
                    <div class="text-wrapper">
                        <p class="profile-name">{{ getStore('auth/getAuth').name }}</p>
                        <p class="designation">{{ getStore('auth/getAuth').email }}</p>
                    </div>

                </a>
            </li>
            <li class="nav-item nav-category">
                <span class="nav-link">Management</span>
            </li>
            <li :id="`sidebar-li-${key}`" v-for="(current_sidebar,key) in sidebar_list" class="nav-item" :class="{'active':current_sidebar?.is_active}">
                <a class="nav-link" data-toggle="collapse" :href="`#ui-basic${key}`" aria-expanded="false"
                   aria-controls="ui-basic">
                    <span class="menu-title">{{ current_sidebar.meta.label }}</span>
                    <i class="icon-layers menu-icon"></i>
                </a>
                <div class="collapse" :id="`ui-basic${key}`" :class="{'show':current_sidebar?.is_active}">
                    <div v-for="submenu in current_sidebar.children">
                        <ul v-if="submenu?.meta?.sidebar" class="nav flex-column sub-menu">
                            <li class="nav-item">
                                <router-link class="nav-link" :to="{name: submenu.name}">
                                    {{ submenu.meta.label }}
                                </router-link>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </nav>
</template>
<script>
import {setSideBar} from "@/Common/index.js";
import {getStore} from "../Helper/index.js";

export default {
    name: 'Sidebar',
    setup: () => {
        let state = setSideBar()
        const test = (id)=>{
            let nav_item_id = `sidebar-li-${id}`;
           let parent = document.getElementById(nav_item_id);
            let nav = document.getElementsByClassName('nav-item')
            for(let i in nav){
                if(nav[i].id)
                if(nav_item_id != nav[i].id) {
                    if(nav[i].length > 0) {
                        nav[i]?.classList?.remove("active");
                        nav[i].querySelector('.collapse')?.classList?.remove('show')
                    }
                }
            }
            /*nav.map((value)=>{
                value.classList.remove("active");
            })*/


        }
        return {...state,test,getStore}
    }
}
</script>
