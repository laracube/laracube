<template>
    <div v-if="!fetching">
        <v-autocomplete
            v-model="selected"
            :items="response"
            chips
            deletable-chips
            multiple
            clearable
            @change="filterChanged()"
        ></v-autocomplete>
    </div>
</template>

<script>
import filter from '@/mixins/filter';

export default {
    name: 'SingleSelect',
    mixins: [filter],
};
</script>
