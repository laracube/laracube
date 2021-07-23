<template>
    <div class="fill-height">
        <div v-if="resource.component === 'table'" class="fill-height">
            <laracube-table :resource="resource"></laracube-table>
        </div>
        <div v-if="resource.component === 'big-number'" class="fill-height">
            <big-number :resource="resource"></big-number>
        </div>
        <div v-if="resource.component === 'card'" class="fill-height">
            <card :resource="resource"></card>
        </div>
    </div>
</template>

<script>
import LaracubeTable from '@/components/resources/Table';
import BigNumber from '@/components/resources/BigNumber';
import Card from '@/components/resources/Card';

export default {
    name: 'RenderResource',
    components: { Card, BigNumber, LaracubeTable },
    props: {
        resource: { required: true },
    },
};
</script>
