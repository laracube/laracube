<template>
    <div class="d-flex align-center">
        <v-card-title class="grey--text text--darken-2 pr-2" v-if="resource.heading" v-html="resource.heading">
        </v-card-title>
        <v-tooltip right v-if="resource.subHeading">
            <template v-slot:activator="{ on, attrs }">
                <i class="fas fa-info-circle grey--text text--darken-1" v-bind="attrs" v-on="on"></i>
            </template>
            <span v-html="resource.subHeading"></span>
        </v-tooltip>
    </div>
</template>

<script>
export default {
    name: 'ResourceHeading',
    props: {
        resource: { required: true },
    },
};
</script>
