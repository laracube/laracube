<template>
    <div v-if="heading || subHeading">
        <div v-if="!loading">
            <h2 class="font-weight-medium" v-if="heading" v-html="heading"></h2>
            <p
                class="pt-2 text--secondary"
                v-if="subHeading"
                v-html="subHeading"
            ></p>
        </div>
        <div v-else>
            <page-heading-skeleton></page-heading-skeleton>
        </div>
    </div>
</template>

<script>
import PageHeadingSkeleton from '@/components/skeleton/PageHeadingSkeleton';

export default {
    name: 'PageHeading',
    components: { PageHeadingSkeleton },
    props: {
        loading: { required: false, default: true },
        heading: { required: false, default: null },
        subHeading: { required: false, default: null },
    },
};
</script>
