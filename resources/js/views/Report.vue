<template>
    <div>
        <page-heading
            :heading="report.meta.heading"
            :sub-heading="report.meta.subHeading"
            :loading="loading"
        >
        </page-heading>
        <v-row class="mt-5">
            <v-col
                cols="12"
                :sm="resource.columns || 3"
                v-for="(resource, index) in report.resources"
                :key="index"
            >
                <render-resource :resource="resource"></render-resource>
            </v-col>
        </v-row>
    </div>
</template>

<script>
import PageHeading from '@/components/ui/PageHeading';
import RenderResource from '@/components/resources/RenderResource';

export default {
    name: 'Report',
    components: { PageHeading, RenderResource },
    data() {
        return {
            loading: true,
            report: {
                meta: {
                    uriKey: null,
                    navigation: null,
                    heading: null,
                    subHeading: null,
                },
                resources: [],
            },
        };
    },
    created() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            this.loading = true;

            this.$axios
                .get(`/laracube-api/report/${this.$route.params.uriKey}`)
                .then((response) => {
                    this.report = response.data;
                    document.title = this.report.meta.navigation;
                })
                .catch((error) => {
                    this.$toasted.error(error.message);
                })
                .finally(() => {
                    this.loading = false;
                });
        },
        getResourceRunUrl(resource) {
            return '/laracube-api/run/resource/' + resource.uriKey;
        },
    },
};
</script>
