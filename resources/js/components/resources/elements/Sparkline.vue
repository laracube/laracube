<template>
    <div class="lc-sparkline">
        <v-sparkline
            v-if="data && Array.isArray(data.value)"
            :auto-draw="data.autoDraw"
            :auto-draw-duration="data.autoDrawDuration"
            :auto-draw-easing="data.autoDrawEasing"
            :auto-line-width="data.autoLineWidth"
            :color="data.color"
            :fill="data.fill"
            :gradient="data.gradient"
            :gradient-direction="data.gradientDirection"
            :height="data.height"
            :label-size="data.labelSize"
            :labels="data.labels"
            :lineWidth="data.lineWidth"
            :padding="data.padding"
            :show-labels="data.showLabels"
            :smooth="data.smooth"
            :type="data.type"
            :value="data.value"
            :width="data.width"
            class="mt-4"
        ></v-sparkline>
        <div v-if="data && data.title" class="text-center grey--text text--darken-2">
            <div v-html="data.title"></div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Sparkline',
    props: {
        data: { required: true },
    },
};
</script>
