<template>
    <v-card flat class="lc-shadow lc-rounded fill-height">
        <v-card-title
            v-if="resource.heading"
            class="grey--text text--darken-2 pr-2"
            v-html="resource.heading"
        >
        </v-card-title>
        <v-tooltip right v-if="resource.subHeading">
            <template v-slot:activator="{ on, attrs }">
                <i
                    class="fas fa-info-circle grey--text text--darken-1"
                    v-bind="attrs"
                    v-on="on"
                ></i>
            </template>
            <span v-html="resource.subHeading"></span>
        </v-tooltip>
        <v-card-text class="px-0">
            <div v-if="!fetching">
                <v-data-table
                    :headers="pagination.meta.columns"
                    :items="pagination.data"
                    :items-per-page="itemsPerPage"
                    :options.sync="options"
                    hide-default-footer
                >
                    <template
                        v-for="column in pagination.meta.columns"
                        v-slot:[`header.${column.value}`]="{ header }"
                    >
                        <v-tooltip top v-if="column.tooltip">
                            <template v-slot:activator="{ on }">
                                <span
                                    class="grey--text text--darken-2"
                                    v-on="on"
                                    v-html="column.text"
                                ></span>
                            </template>
                            <span>{{ column.tooltip }}</span>
                        </v-tooltip>
                        <template v-else>
                            <span
                                class="grey--text text--darken-2"
                                v-html="column.text"
                            ></span>
                        </template>
                    </template>
                    <template
                        v-for="column in pagination.meta.columns"
                        v-slot:[`item.${column.value}`]="{ item }"
                    >
                        <div v-html="item[column.value]"></div>
                    </template>
                </v-data-table>
                <v-row
                    no-gutters
                    class="pt-2 align-center"
                    v-if="resource.type === 'paginated'"
                >
                    <v-col class="pl-5 grey--text text--darken-2">
                        Showing
                        <span class="font-weight-bold">
                            {{ pagination.meta.from }}
                        </span>
                        to
                        <span class="font-weight-bold">
                            {{ pagination.meta.to }}
                        </span>
                        of
                        <span class="font-weight-bold">
                            {{ pagination.meta.total }}
                        </span>
                        results
                    </v-col>
                    <v-col v-if="pagination.meta.last_page !== 1">
                        <v-pagination
                            v-model="page"
                            :length="pagination.meta.last_page"
                            :total-visible="5"
                            class="float-right pr-3 grey--text text--darken-2"
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
        itemsPerPage() {
            return this.pagination.meta.per_page || this.pagination.data.length;
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
