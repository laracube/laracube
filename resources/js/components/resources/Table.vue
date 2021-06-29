<template>
    <v-card flat class="shadow">
        <v-card-title v-if="resource.heading">
            {{ resource.heading }}
        </v-card-title>
        <v-card-subtitle v-if="resource.subHeading">
            {{ resource.subHeading }}
        </v-card-subtitle>
        <v-card-text class="px-0">
            <div v-if="!fetching">
                <v-data-table
                    :headers="pagination.meta.columns"
                    :items="pagination.data"
                    :items-per-page="pagination.meta.per_page"
                    :options.sync="options"
                    hide-default-footer
                >
                    <template
                        v-for="columns in pagination.meta.columns"
                        v-slot:[`header.${columns.value}`]="{ header }"
                    >
                        <v-tooltip top v-if="columns.tooltip">
                            <template v-slot:activator="{ on }">
                                <span v-on="on">{{ columns.text }}</span>
                            </template>
                            <span>{{ columns.tooltip }}</span>
                        </v-tooltip>
                        <template v-else>
                            {{ columns.text }}
                        </template>
                    </template>
                </v-data-table>
                <v-row
                    no-gutters
                    class="pt-2 align-center"
                    v-if="resource.type === 'paginated'"
                >
                    <v-col class="pl-5">
                        Showing
                        <span class="font-weight-medium">
                            {{ pagination.meta.from }}
                        </span>
                        to
                        <span class="font-weight-medium">
                            {{ pagination.meta.to }}
                        </span>
                        of
                        <span class="font-weight-medium">
                            {{ pagination.meta.total }}
                        </span>
                        results
                    </v-col>
                    <v-col v-if="pagination.meta.last_page !== 1">
                        <v-pagination
                            v-model="page"
                            :length="pagination.meta.last_page"
                            :total-visible="5"
                            class="float-right pr-3"
                        ></v-pagination>
                    </v-col>
                </v-row>
            </div>
            <div v-else>
                <table-skeleton></table-skeleton></div
        ></v-card-text>
    </v-card>
</template>

<script>
import pagination from '@/mixins/pagination';
import TableSkeleton from '@/components/skeleton/TableSkeleton';

export default {
    name: 'Table',
    components: { TableSkeleton },
    mixins: [pagination],
    props: {
        resource: { required: true },
    },
    computed: {
        url() {
            return '/laracube-api/run/resource/' + this.resource.uriKey;
        },
    },
    watch: {
        page: {
            handler() {
                this.fetchData();
            },
        },
        deep: true,
    },
};
</script>
