<template>
    <v-card flat class="lc-shadow fill-height lc-rounded">
        <resource-heading :resource="resource"></resource-heading>
        <v-card-text>
            <div v-if="!fetching">
                <div class="d-flex flex-column" v-for="element in response">
                    <div v-if="element.type === 'bigNumber'" class="mb-5">
                        <big-number :data="element.data"></big-number>
                    </div>
                    <div v-if="element.type === 'sparkline'" class="mb-5">
                        <sparkline :data="element.data"></sparkline>
                    </div>
                    <div v-if="element.type === 'customHtml'" class="mb-5">
                        <custom-html :data="element.data"></custom-html>
                    </div>
                </div>
            </div>
            <div v-else>
                <universal-skeleton></universal-skeleton>
            </div>
        </v-card-text>
    </v-card>
</template>

<script>
import Sparkline from '@/components/resources/elements/Sparkline';
import ResourceHeading from '@/components/resources/elements/ResourceHeading';
import UniversalSkeleton from '@/components/skeleton/UniversalSkeleton';
import BigNumber from '@/components/resources/elements/BigNumber';
import CustomHtml from '@/components/resources/elements/CustomHtml';

export default {
    name: 'Card',
    components: {
        CustomHtml,
        BigNumber,
        UniversalSkeleton,
        ResourceHeading,
        Sparkline,
    },
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
                .get(this.url)
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
    },
};
</script>
