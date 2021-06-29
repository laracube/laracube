<template>
    <div>
        <v-row no-gutter>
            <v-col class="pb-0">
                <v-skeleton-loader
                    tile
                    width="60%"
                    height="40px"
                    class="mx-auto"
                    type="image"
                ></v-skeleton-loader>
            </v-col>
        </v-row>
    </div>
</template>

<script>
export default {
    name: 'BigNumberSkeleton',
};
</script>
