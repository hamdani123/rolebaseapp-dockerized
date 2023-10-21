<template>
    <div class="container-scroller">
        <!--Header-->
        <Header/>
        <div class="container-fluid page-body-wrapper">
            <!-- Sidebar -->
            <Sidebar/>
            <!-- sidebar -->
            <div class="main-panel">
                <!--Content-->
                <div class="content-wrapper">
                    <router-view v-slot="{ Component }">
                        <transition>
                            <component :is="Component" />
                        </transition>
                    </router-view>
                </div>
                <!--Content-->

                <!-- Footer -->
                <Footer/>
                <!-- Footer -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
</template>
<script>
import Loader from "@/components/Loader.vue";
import Header from "@/components/Header.vue";
import Sidebar from "@/components/Sidebar.vue";
import Footer from "@/components/Footer.vue";

export default{

    components: {
        Loader,
        Header,
        Sidebar,
        Footer
    },
    mounted(){

    },
    computed: {

    },
    methods:{

    }
}
</script>
