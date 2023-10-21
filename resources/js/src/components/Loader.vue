<template>
    <div id="spinner" class="loading">
        <div id="loading">
            <span class="timer-loader">Loading…</span>
        </div>
    </div>
</template>
<script>
export default {
    name: "loader",
    props: ["visible"]
};
</script>

<style scoped>
@import './../../../css/loader.css';
@import './../../../css/spinner.css';
</style>
