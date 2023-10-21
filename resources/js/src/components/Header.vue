<template>
    <!-- partial:../../partials/_navbar.html -->
    <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="navbar-brand-wrapper d-flex align-items-center">
            <router-link class="navbar-brand brand-logo" :to="{name:'dashboard'}">
                <img src="/images/logo.svg" alt="logo" class="logo-dark" />
            </router-link>
            <router-link class="navbar-brand brand-logo-mini" :to="{name:'dashboard'}"><img src="/images/logo-mini.svg" alt="logo" /></router-link>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center flex-grow-1">
            <h5 class="mb-0 font-weight-medium d-none d-lg-flex">Welcome</h5>
            <ul class="navbar-nav navbar-nav-right ml-auto">

                <li class="nav-item dropdown language-dropdown d-none d-sm-flex align-items-center">
<!--                    <a class="nav-link d-flex align-items-center dropdown-toggle" id="LanguageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                        <div class="d-inline-flex mr-3">
                            <i class="flag-icon flag-icon-us"></i>
                        </div>
                        <span class="profile-text font-weight-normal">English</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-left navbar-dropdown py-2" aria-labelledby="LanguageDropdown">
                        <a class="dropdown-item">
                            <i class="flag-icon flag-icon-us"></i> English </a>
                        <a class="dropdown-item">
                            <i class="flag-icon flag-icon-fr"></i> French </a>
                        <a class="dropdown-item">
                            <i class="flag-icon flag-icon-ae"></i> Arabic </a>
                        <a class="dropdown-item">
                            <i class="flag-icon flag-icon-ru"></i> Russian </a>
                    </div>-->
                </li>
                <li class="nav-item dropdown d-none d-xl-inline-flex user-dropdown">
                    <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                        <img class="img-xs rounded-circle ml-2" src="/images/faces/face8.jpg" alt="Profile image"> <span class="font-weight-normal">{{getStore('auth/getAuth').name}}</span></a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                        <div class="dropdown-header text-center">
                            <img class="img-md rounded-circle" src="/images/faces/face8.jpg" alt="Profile image">
                            <p class="mb-1 mt-3">{{getStore('auth/getAuth').name}}</p>
                            <p class="font-weight-light text-muted mb-0">{{getStore('auth/getAuth').email}}</p>
                        </div>
                        <a class="dropdown-item"><i class="dropdown-item-icon icon-user text-primary"></i> My Profile <span class="badge badge-pill badge-danger">1</span></a>
                        <a @click="logout" class="dropdown-item"><i class="dropdown-item-icon icon-power text-primary"></i>Sign Out</a>
                    </div>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                <span class="icon-menu"></span>
            </button>
        </div>
    </nav>
    <!-- partial -->
</template>

<script>
import {removeToken} from "@/Helper";
import router from "@/router";
import {getStore} from "../Helper/index.js";
export default {
    name:'Header',
    methods:{
        getStore,
        logout(){
            removeToken()
            router.push({name:'Login'})
        }
    }
}
</script>
