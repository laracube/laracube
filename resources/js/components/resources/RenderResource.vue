<template>
    <div class="fill-height">
        <div v-if="resource.component === 'table'" class="fill-height">
            <laracube-table :resource="resource" :report="report" :key="resource.uriKey"></laracube-table>
        </div>
        <div v-if="resource.component === 'card'" class="fill-height">
            <card :resource="resource" :report="report" :key="resource.uriKey"></card>
        </div>
    </div>
</template>

<script>
import LaracubeTable from '@/components/resources/Table';
import Card from '@/components/resources/Card';

export default {
    name: 'RenderResource',
    components: { Card, LaracubeTable },
    props: {
        resource: { required: true },
        report: { required: true },
    },
};
</script>
