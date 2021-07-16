<template>
    <v-card flat class="shadow fill-height">
        <v-card-title v-if="resource.heading" v-html="resource.heading">
        </v-card-title>
        <v-card-subtitle
            v-if="resource.subHeading"
            v-html="resource.subHeading"
        >
        </v-card-subtitle>
        <v-card-text>
            <div v-if="!fetching">
                <div class="d-flex flex-column">
                    <div class="d-flex justify-space-between align-center">
                        <div class="d-flex flex-column">
                            <div
                                class="text-h2 font-weight-medium line1"
                                v-if="response.line1 && response.line1.value"
                                v-html="response.line1.value"
                            ></div>
                            <div
                                class="text-h5 font-weight-medium pl-1 line2"
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
                    <v-sparkline
                        v-if="
                            response.sparkline &&
                            Array.isArray(response.sparkline.value)
                        "
                        :auto-draw="response.sparkline.autoDraw"
                        :auto-draw-duration="
                            response.sparkline.autoDrawDuration
                        "
                        :auto-draw-easing="response.sparkline.autoDrawEasing"
                        :auto-line-width="response.sparkline.autoLineWidth"
                        :color="response.sparkline.color"
                        :fill="response.sparkline.fill"
                        :gradient="response.sparkline.gradient"
                        :gradient-direction="
                            response.sparkline.gradientDirection
                        "
                        :height="response.sparkline.height"
                        :label-size="response.sparkline.labelSize"
                        :labels="response.sparkline.labels"
                        :lineWidth="response.sparkline.lineWidth"
                        :padding="response.sparkline.padding"
                        :show-labels="response.sparkline.showLabels"
                        :smooth="response.sparkline.smooth"
                        :type="response.sparkline.type"
                        :value="response.sparkline.value"
                        :width="response.sparkline.width"
                        class="mt-4"
                    ></v-sparkline>
                    <div
                        v-if="response.sparkline && response.sparkline.title"
                        class="text-center"
                    >
                        <div v-html="response.sparkline.title"></div>
                    </div>
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
                sparkline: {
                    title: null,
                    value: null,
                    labels: null,
                },
            },
            sparklineConfig: {},
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
