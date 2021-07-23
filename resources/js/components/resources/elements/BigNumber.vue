<template>
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
                :class="data.line1.cssClass"
                v-if="data.line1 && data.line1.value"
                v-html="data.line1.value"
            ></div>
            <div
                class="text-h6 grey--text text--darken-2 pl-1 line2"
                :class="data.line2.cssClass"
                v-if="data.line2 && data.line2.value"
                v-html="data.line2.value"
            ></div>
        </div>
        <div v-if="data.trend && data.trend.value">
            <div
                class="
                    d-flex
                    align-center
                    text-h6
                    font-weight-medium
                    px-2
                    py-2
                    trend
                "
                :class="data.trend.cssClass"
            >
                <span
                    v-if="data.trend.icon.value"
                    :class="data.trend.icon.cssClass"
                    class="mr-2"
                >
                    <i class="fas" :class="data.trend.icon.value"></i>
                </span>
                <span v-html="data.trend.value"></span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'BigNumber',
    props: {
        data: { required: true },
    },
};
</script>
