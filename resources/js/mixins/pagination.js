export default {
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
        this.fetchData();
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
