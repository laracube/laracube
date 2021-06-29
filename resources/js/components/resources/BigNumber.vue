<template>
    <v-card flat class="shadow">
        <v-card-title v-if="resource.heading" class="justify-center">
            {{ resource.heading }}
        </v-card-title>
        <v-card-subtitle v-if="resource.subHeading" class="justify-center">
            {{ resource.subHeading }}
        </v-card-subtitle>
        <v-card-text class="px-0 text-center">
            <div v-if="!fetching" class="text-h2 font-weight-medium">
                {{ response.number }}
            </div>
            <div v-else>
                <big-number-skeleton></big-number-skeleton>
            </div>
        </v-card-text>
    </v-card>
</template>

<script>
import BigNumberSkeleton from '@/components/skeleton/BigNumberSkeleton';
export default {
    name: 'BigNumber',
    components: { BigNumberSkeleton },
    props: {
        resource: { required: true },
    },
    computed: {
        url() {
            return '/laracube-api/run/resource/' + this.resource.uriKey;
        },
    },
    data() {
        return {
            fetching: true,
            response: {
                number: null,
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
            axios
                .get(this.url)
                .then(({ data }) => {
                    this.response = data;
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

<style scoped></style>
