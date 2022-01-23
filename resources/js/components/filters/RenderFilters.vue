<template>
    <div>
        <div v-if="Array.isArray(report.filters) && report.filters.length">
            <v-dialog v-model="filterDialog" fullscreen hide-overlay transition="dialog-bottom-transition">
                <template #activator="{ on: dialog }">
                    <v-tooltip left>
                        <template #activator="{ on: tooltip }">
                            <v-badge :content="appliedFilterCount" :value="appliedFilterCount" color="primary">
                                <v-icon v-on="{ ...tooltip, ...dialog }"> mdi-filter-variant </v-icon>
                            </v-badge>
                        </template>
                        <span>Filters</span>
                    </v-tooltip>
                </template>
                <v-card>
                    <v-toolbar dark color="primary" tile flat class="lc-shadow">
                        <v-btn icon dark @click="closeDialog">
                            <v-icon>mdi-close</v-icon>
                        </v-btn>
                        <v-toolbar-title>Filters</v-toolbar-title>
                        <v-spacer></v-spacer>
                        <v-toolbar-items>
                            <v-btn dark text @click="resetAll"> <v-icon>mdi-refresh</v-icon> Reset all </v-btn>
                        </v-toolbar-items>
                    </v-toolbar>
                    <v-list three-line subheader class="mt-5">
                        <v-list-item v-for="filter in report.filters" :key="filter.key">
                            <v-list-item-content>
                                <v-list-item-title>
                                    {{ filter.heading }}
                                </v-list-item-title>
                                <div v-if="filter.type === 'single-select'">
                                    <single-select
                                        :report="report"
                                        :filter="filter"
                                        :refresh="filterDialog"
                                        @filter-changed="filterChanged"
                                        :key="filter.key"
                                    ></single-select>
                                </div>
                                <div v-if="filter.type === 'multiple-select'">
                                    <multiple-select
                                        :report="report"
                                        :filter="filter"
                                        :refresh="filterDialog"
                                        @filter-changed="filterChanged"
                                        :key="filter.key"
                                    ></multiple-select>
                                </div>
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
import { mapMutations } from 'vuex';
import SingleSelect from '@/components/filters/elements/SingleSelect';
import MultipleSelect from '@/components/filters/elements/MultipleSelect';
import _ from 'lodash';

export default {
    name: 'RenderFilters',
    components: { SingleSelect, MultipleSelect },
    props: {
        report: { required: true },
    },
    mounted() {
        if (Array.isArray(this.report.filters) && this.report.filters.length) {
            this.resetFilters();
            if (!this.reportFilters.hasOwnProperty(this.report.meta.uriKey)) {
                this.reportFilters[this.report.meta.uriKey] = {};
            }
        }
    },
    computed: {
        appliedFilterCount() {
            if (this.reportFilters.hasOwnProperty(this.report.meta.uriKey)) {
                return _.size(this.reportFilters[this.report.meta.uriKey]);
            }
            return 0;
        },
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
            let condition =
                !!(!Array.isArray(args.selected) && args.selected) ||
                !!(Array.isArray(args.selected) && args.selected.length);
            if (condition) {
                this.reportFilters[this.report.meta.uriKey][args.filterKey] = args.selected;
            } else {
                delete this.reportFilters[this.report.meta.uriKey][args.filterKey];
            }
        },
        applyFilters() {
            this.setFilters(_.cloneDeep(this.reportFilters));
            this.$emit('filter-applied');
            this.resetFilters();
            this.filterDialog = false;
        },
        closeDialog() {
            this.resetFilters();
            this.filterDialog = false;
        },
        resetAll() {
            this.reportFilters[this.report.meta.uriKey] = {};
            this.setFilters(_.cloneDeep(this.reportFilters));
            this.$emit('filter-applied');
            this.resetFilters();
            this.filterDialog = false;
        },
        resetFilters() {
            this.reportFilters = _.cloneDeep(this.$store.state.filters.filters);
        },
    },
};
</script>
