<template>
    <v-card flat class="lc-shadow fill-height lc-rounded">
        <v-card-text>
            <div v-if="!fetching">
                <div class="d-flex flex-column">
                    <div class="d-flex justify-space-between align-center">
                        <div class="d-flex flex-column">
                            <div
                                class="
                                    text-h3
                                    grey--text
                                    text--darken-3
                                    font-weight-medium
                                    line1
                                "
                                v-if="response.line1 && response.line1.value"
                                v-html="response.line1.value"
                            ></div>
                            <div
                                class="
                                    text-h6
                                    grey--text
                                    text--darken-2
                                    pl-1
                                    line2
                                "
                                v-if="response.line2 && response.line2.value"
                                v-html="response.line2.value"
                            ></div>
                        </div>
                        <div v-if="response.trend && response.trend.value">
                            <div
                                class="
                                    d-flex
                                    text-h6
                                    font-weight-medium
                                    px-2
                                    py-2
                                    rounded
                                    shadow-sm
                                    trend
                                "
                                :class="response.trend.class"
                            >
                                <span v-if="response.trend.icon">
                                    <i
                                        class="fas pr-1"
                                        :class="response.trend.icon"
                                    ></i>
                                </span>
                                <span v-html="response.trend.value"></span>
                            </div>
                        </div>
                    </div>
                    <sparkline :sparkline="response.sparkline"></sparkline>
                </div>
            </div>
            <div v-else>
                <big-number-skeleton></big-number-skeleton>
            </div>
        </v-card-text>
    </v-card>
</template>

<script>
import BigNumberSkeleton from '@/components/skeleton/BigNumberSkeleton';
import Sparkline from '@/components/resources/elements/Sparkline';

export default {
    name: 'BigNumber',
    components: { Sparkline, BigNumberSkeleton },
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
                line1: {
                    value: null,
                },
                line2: {
                    value: null,
                },
                trend: {
                    value: null,
                    icon: null,
                    class: null,
                },
                sparkline: {},
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
