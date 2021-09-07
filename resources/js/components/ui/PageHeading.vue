<template>
    <div v-if="heading || subHeading">
        <div class="d-flex align-center" v-if="!loading">
            <h2 class="grey--text text--darken-3 font-weight-medium pr-2" v-if="heading" v-html="heading"></h2>
            <v-tooltip right v-if="subHeading">
                <template v-slot:activator="{ on, attrs }">
                    <i class="fas fa-info-circle grey--text text--darken-1" v-bind="attrs" v-on="on"></i>
                </template>
                <span v-html="subHeading"></span>
            </v-tooltip>
        </div>
        <div v-else>
            <universal-skeleton></universal-skeleton>
        </div>
    </div>
</template>

<script>
import UniversalSkeleton from '@/components/skeleton/UniversalSkeleton';

export default {
    name: 'PageHeading',
    components: { UniversalSkeleton },
    props: {
        loading: { required: false, default: true },
        heading: { required: false, default: null },
        subHeading: { required: false, default: null },
    },
};
</script>
