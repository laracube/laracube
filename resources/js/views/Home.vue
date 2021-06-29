<template>
    <div></div>
</template>

<script>
export default {
    name: 'Home',
    created() {
        this.$router.push({
            name: 'report',
            params: {
                uriKey: window.LaracubeConfig.landingReport,
            },
        });
    },
};
</script>
