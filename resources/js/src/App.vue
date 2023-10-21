<template>
    <Loader v-if="$store.getters['loading/getLoaderStatus']" />
    <RouterView/>
</template>

<script>

import Loader from "@/components/Loader.vue";
import AuthLayout from "@/Layouts/AuthLayout.vue";

export default{
    components: {
        Loader,
        AuthLayout
    },
}

</script>
