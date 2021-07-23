<template>
    <div>
        <div
            :class="data.cssClass"
            v-if="data && data.value"
            v-html="data.value"
        ></div>
    </div>
</template>

<script>
export default {
    name: 'CustomHtml',
    props: {
        data: { required: true },
    },
};
</script>
