<template>
    <div>
        <div class="d-flex align-center justify-space-between">
            <page-heading :heading="report.meta.heading" :sub-heading="report.meta.subHeading" :loading="loading">
            </page-heading>
            <div class="float-right">
                <render-filters v-if="!loading" :report="report"></render-filters>
            </div>
        </div>
        <v-row class="mt-5">
            <v-col
                cols="12"
                :md="resource.columns || 3"
                :sm="12"
                v-for="(resource, index) in report.resources"
                :key="index"
            >
                <render-resource :report="report" :resource="resource"></render-resource>
            </v-col>
        </v-row>
    </div>
</template>

<script>
import PageHeading from '@/components/ui/PageHeading';
import RenderResource from '@/components/resources/RenderResource';
import RenderFilters from '@/components/filters/RenderFilters';

export default {
    name: 'Report',
    components: { RenderFilters, PageHeading, RenderResource },
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
                filters: [],
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
                .post(`/laracube-api/report/${this.$route.params.uriKey}`)
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
    },
};
</script>
