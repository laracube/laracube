<template>
    <div>
        <div v-if="resource.component === 'table'">
            <laracube-table :resource="resource"></laracube-table>
        </div>
        <div v-if="resource.component === 'big-number'">
            <big-number :resource="resource"></big-number>
        </div>
    </div>
</template>

<script>
import LaracubeTable from '@/components/resources/Table';
import BigNumber from '@/components/resources/BigNumber';

export default {
    name: 'RenderResource',
    components: { BigNumber, LaracubeTable },
    props: {
        resource: { required: true },
    },
};
</script>
