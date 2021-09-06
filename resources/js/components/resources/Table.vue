<template>
    <v-card flat class="lc-shadow lc-rounded fill-height">
        <v-card-title v-if="resource.heading" class="grey--text text--darken-2 pr-2" v-html="resource.heading">
        </v-card-title>
        <v-tooltip right v-if="resource.subHeading">
            <template v-slot:activator="{ on, attrs }">
                <i class="fas fa-info-circle grey--text text--darken-1" v-bind="attrs" v-on="on"></i>
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
                    <template v-for="column in pagination.meta.columns" v-slot:[`header.${column.value}`]="{ header }">
                        <v-tooltip top v-if="column.tooltip">
                            <template v-slot:activator="{ on }">
                                <span class="grey--text text--darken-2" v-on="on" v-html="column.text"></span>
                            </template>
                            <span>{{ column.tooltip }}</span>
                        </v-tooltip>
                        <template v-else>
                            <span class="grey--text text--darken-2" v-html="column.text"></span>
                        </template>
                    </template>
                    <template v-for="column in pagination.meta.columns" v-slot:[`item.${column.value}`]="{ item }">
                        <div v-html="item[column.value]"></div>
                    </template>
                </v-data-table>
                <v-row
                    no-gutters
                    class="pt-2 align-center"
                    v-if="resource.type === 'paginated' && pagination.meta.total"
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
                <universal-skeleton></universal-skeleton>
            </div>
        </v-card-text>
    </v-card>
</template>

<script>
import UniversalSkeleton from '@/components/skeleton/UniversalSkeleton';
import _ from 'lodash';

export default {
    name: 'Table',
    components: { UniversalSkeleton },
    props: {
        resource: { required: true },
        report: { required: true },
    },
    computed: {
        url() {
            return '/laracube-api/run/resource/' + this.resource.uriKey;
        },
        itemsPerPage() {
            return this.pagination.meta.per_page || this.pagination.data.length;
        },
        filters() {
            this.reportFilters = this.$store.state.filters.filters;
            if (this.reportFilters.hasOwnProperty(this.report.meta.uriKey)) {
                return this.reportFilters[this.report.meta.uriKey];
            }
            return null;
        },
    },
    data() {
        return {
            page: 1,
            fetching: true,
            options: {},
            pagination: {
                data: [],
                links: {
                    first: null,
                    last: null,
                    prev: null,
                    next: null,
                },
                meta: {
                    current_page: null,
                    from: null,
                    last_page: null,
                    path: null,
                    per_page: null,
                    to: null,
                    total: null,
                    links: [],
                    columns: [],
                },
            },
        };
    },
    mounted() {
        this.fetchData(_.cloneDeep(this.filters));
    },
    watch: {
        page: {
            handler() {
                this.fetchData(_.cloneDeep(this.filters));
            },
        },
        filters: {
            handler() {
                this.fetchData(_.cloneDeep(this.filters));
            },
        },
        deep: true,
    },
    methods: {
        fetchData(params) {
            this.fetching = true;
            if (this.url === undefined) {
                throw 'url data property not defined';
            }
            if (params) {
                params.page = this.page;
            } else {
                params = {
                    page: this.page,
                };
            }
            this.$axios
                .post(this.url, params)
                .then(({ data }) => {
                    this.pagination = data;
                })
                .catch((error) => {
                    this.$toasted.error(error.message);
                })
                .finally(() => {
                    this.fetching = false;
                });
        },
    },
};
</script>
