<template>
    <div>
        <v-skeleton-loader
            width="100%"
            class="float-left"
            type="table-tbody, table-tfoot"
            tile
        ></v-skeleton-loader>
    </div>
</template>

<script>
export default {
    name: 'TableSkeleton',
};
</script>
