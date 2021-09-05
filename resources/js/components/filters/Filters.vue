<template>
    <div>
        <div v-if="Array.isArray(report.filters) && report.filters.length">
            <v-dialog v-model="filterDialog" fullscreen hide-overlay transition="dialog-bottom-transition">
                <template #activator="{ on: dialog }">
                    <v-tooltip left>
                        <template #activator="{ on: tooltip }">
                            <v-icon v-on="{ ...tooltip, ...dialog }"> mdi-filter-variant </v-icon>
                        </template>
                        <span>Filters</span>
                    </v-tooltip>
                </template>
                <v-card>
                    <v-toolbar dark color="primary" tile flat class="lc-shadow">
                        <v-btn icon dark @click="filterDialog = false">
                            <v-icon>mdi-close</v-icon>
                        </v-btn>
                        <v-toolbar-title>Filters</v-toolbar-title>
                        <v-spacer></v-spacer>
                        <v-toolbar-items>
                            <v-btn dark text @click="resetFilters"> <v-icon>mdi-refresh</v-icon> Reset all </v-btn>
                        </v-toolbar-items>
                    </v-toolbar>
                    <v-list three-line subheader class="mt-5">
                        <v-list-item v-for="filter in report.filters" :key="filter.key">
                            <v-list-item-content>
                                <v-list-item-title>
                                    {{ filter.heading }}
                                </v-list-item-title>
                                <render-filter
                                    :report="report"
                                    :filter="filter"
                                    @filter-changed="filterChanged"
                                ></render-filter>
                            </v-list-item-content>
                        </v-list-item>
                        <v-list-item>
                            <v-list-item-content>
                                <v-btn
                                    elevation="0"
                                    tile
                                    large
                                    color="primary"
                                    class="lc-shadow px-15"
                                    @click="applyFilters"
                                >
                                    Apply Filters
                                </v-btn>
                            </v-list-item-content>
                        </v-list-item>
                    </v-list>
                </v-card>
            </v-dialog>
        </div>
    </div>
</template>

<script>
import RenderFilter from '@/components/filters/RenderFilter';
import { mapMutations, mapState } from 'vuex';

export default {
    name: 'Filters',
    components: { RenderFilter },
    props: {
        report: { required: true },
    },
    computed: {
        ...mapState('filters', ['filters']),
    },
    mounted() {
        if (Array.isArray(this.report.filters) && this.report.filters.length) {
            this.reportFilters = { ...this.filters };
            // set report filters
            if (!this.reportFilters.hasOwnProperty(this.report.meta.uriKey)) {
                this.reportFilters[this.report.meta.uriKey] = {};
            }
            for (const filter in this.report.filters) {
                if (!this.reportFilters.hasOwnProperty(this.report.meta.uriKey)) {
                    this.reportFilters[this.report.meta.uriKey] = {};
                }
                console.log(this.report.filters[filter]);
            }
            // let reportFilters = this.reportFilters[this.report.meta.uriKey];
            //
            // for (i = 0; i < this.report.filters.length; i++) {
            //     if (
            //         !this.reportFilters[this.report.meta.uriKey].hasOwnProperty(
            //             this.report.filter[i].key,
            //         )
            //     ) {
            //         this.reportFilters[this.report.meta.uriKey] = {};
            //     }
            //
            //     this.report.filters.forEach(function (filter) {
            //         if (!reportFilters.hasOwnProperty(filter.key)) {
            //             this.reportFilters[this.report.meta.uriKey][
            //                 filter.key
            //             ] = {};
            //         }
            //     });

            // for (filter in ) {
            //     if (!reportFilters.hasOwnProperty(filter.key)) {
            //         this.reportFilters[this.report.meta.uriKey] = {};
            //     }
            // }
        }
    },
    data() {
        return {
            filterDialog: null,
            reportFilters: {},
        };
    },
    methods: {
        ...mapMutations('filters', {
            setFilters: 'SET_FILTERS',
        }),
        filterChanged(args) {
            // set the new local report filter
            console.log('set the new local report filter');
            console.log(args.filterKey);
            console.log(args.selected);
            this.reportFilters[this.report.meta.uriKey][args.filterKey] = args.selected;
        },
        applyFilters() {
            // save the filter in store
            this.setFilters(this.reportFilters);
            this.$emit('filter-applied');
            this.filterDialog = false;
        },
        resetFilters() {
            this.reportFilters[this.report.meta.uriKey] = {};
            this.setFilters(this.reportFilters);
            this.$emit('filter-applied');
            this.filterDialog = false;
        },
    },
};
</script>
