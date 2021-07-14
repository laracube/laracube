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
        fetchData() {
            this.fetching = true;
            if (this.url === undefined) {
                throw 'url data property not defined';
            }

            const params = {
                page: this.page,
            };

            this.$axios
                .get(this.url, { params })
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
