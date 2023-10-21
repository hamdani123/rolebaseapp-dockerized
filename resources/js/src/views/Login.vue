<template>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">
                            <div v-if="errors?.message" class="alert alert-danger text-center">{{ errors?.message }}
                            </div>
                            <div class="brand-logo">
                                <img src="/images/logo.svg">
                            </div>
                            <h4>Hello! let's get started</h4>
                            <h6 class="font-weight-light">Sign in to continue.</h6>
                            <form class="pt-3" @submit.prevent="login">
                                <div class="form-group">
                                    <input type="email" :class="{'is-invalid':errors?.email}" v-model="email"
                                           class="form-control form-control-lg" id="exampleInputEmail1"
                                           placeholder="Username">
                                    <div v-if="errors?.email" class="invalid-feedback">{{ errors?.email }}</div>
                                </div>
                                <div class="form-group">
                                    <input type="password" v-model="password" class="form-control form-control-lg"
                                           id="exampleInputPassword1" placeholder="Password">
                                </div>
                                <div class="mt-3">
                                    <button type="submit"
                                            class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                                        Login
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
</template>
<script>

import {loginPage} from "@/Common/index.js";

export default {
    name: 'Login',
    setup: () => {


        return {
            ...loginPage()
        }
    }

}
</script>

