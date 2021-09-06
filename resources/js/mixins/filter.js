import _ from 'lodash';

export default {
    data() {
        return {
            selected: null,
            fetching: true,
            response: {},
        };
    },
    mounted() {
        this.applyStoreValue();
        this.fetchData();
    },
    computed: {
        url() {
            return '/laracube-api/run/filter/' + this.filter.uriKey;
        },
    },
    props: {
        report: { required: true },
        filter: { required: true },
        refresh: { required: true },
    },
    watch: {
        refresh: {
            handler() {
                this.applyStoreValue();
            },
        },
        deep: true,
    },
    methods: {
        applyStoreValue() {
            this.selected = null;
            let filters = {};
            filters = _.cloneDeep(this.$store.state.filters.filters);
            let reportUri = this.report.meta.uriKey;
            let filterKey = this.filter.key;
            if (filters.hasOwnProperty(reportUri)) {
                if (filters[reportUri].hasOwnProperty(filterKey)) {
                    this.selected = filters[reportUri][filterKey];
                }
            }
        },
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
        filterChanged() {
            this.$emit('filter-changed', {
                filterKey: this.filter.key,
                selected: this.selected,
            });
        },
    },
};
