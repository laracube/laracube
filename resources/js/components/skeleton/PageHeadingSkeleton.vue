<template>
    <div>
        <v-row no-gutter>
            <v-col class="pb-0">
                <v-skeleton-loader
                    tile
                    width="800"
                    class="float-left"
                    type="heading"
                ></v-skeleton-loader>
            </v-col>
        </v-row>
        <v-row no-gutter>
            <v-col>
                <v-skeleton-loader
                    tile
                    width="800"
                    class="float-left"
                    type="text"
                ></v-skeleton-loader>
            </v-col>
        </v-row>
    </div>
</template>

<script>
export default {
    name: 'PageHeadingSkeleton',
};
</script>
