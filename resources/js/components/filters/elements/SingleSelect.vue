<template>
    <div>
        <v-autocomplete
            v-model="selected"
            :items="items"
            chips
            deletable-chips
            @change="filterChanged()"
        ></v-autocomplete>
    </div>
</template>

<script>
export default {
    name: 'SingleSelect',
    props: {
        report: { required: true },
        filter: { required: true },
        items: { required: true },
        storeSelected: { required: true },
    },
    data() {
        return {
            selected: null,
        };
    },
    mounted() {
        this.selected = this.storeSelected;
    },
    methods: {
        filterChanged() {
            this.$emit('filter-changed', {
                filterKey: this.filter.key,
                selected: this.selected,
            });
        },
    },
};
</script>
