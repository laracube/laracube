<template>
    <div v-if="!fetching">
        <div v-if="filter.type === 'single-select'">
            <single-select
                :report="report"
                :filter="filter"
                :items="response"
                :store-selected="getStoreSelected()"
                @filter-changed="filterChanged"
            ></single-select>
        </div>
        <div v-if="filter.type === 'multiple-select'">
            <multiple-select :filter="filter" :report="report" :response="response"></multiple-select>
        </div>
    </div>
</template>

<script>
import SingleSelect from '@/components/filters/elements/SingleSelect';
import MultipleSelect from '@/components/filters/elements/MultipleSelect';
import { mapState } from 'vuex';
export default {
    name: 'RenderFilter',
    components: { MultipleSelect, SingleSelect },
    props: {
        report: { required: true },
        filter: { required: true },
    },
    computed: {
        url() {
            return '/laracube-api/run/filter/' + this.filter.uriKey;
        },
        ...mapState('filters', ['filters']),
    },
    data() {
        return {
            fetching: true,
            response: {},
        };
    },
    mounted() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            this.fetching = true;
            if (this.url === undefined) {
                throw 'url data property not defined';
            }
            this.$axios
                .post(this.url)
                .then(({ data }) => {
                    this.response = data;
                })
                .catch((error) => {
                    console.log(error);
                    this.$toasted.error(error.message);
                })
                .finally(() => {
                    this.fetching = false;
                });
        },
        getStoreSelected() {
            // check if there is a selected value for this filter
            if (
                this.filters.hasOwnProperty(this.report.meta.uriKey) &&
                this.filters[this.report.meta.uriKey].hasOwnProperty(this.filter.key)
            ) {
                return this.filters[this.report.meta.uriKey][this.filter.key];
            }
            return null;
        },
        filterChanged(args) {
            this.$emit('filter-changed', args);
        },
    },
};
</script>
