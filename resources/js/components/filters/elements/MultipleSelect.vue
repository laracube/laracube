<template>
    <div>
        <v-autocomplete :items="response" chips deletable-chips multiple clearable></v-autocomplete>
    </div>
</template>

<script>
export default {
    name: 'MultipleSelect',
    props: {
        report: { required: true },
        filter: { required: true },
        response: { required: true },
    },
};
</script>
