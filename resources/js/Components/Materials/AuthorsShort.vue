<script setup>
import {computed} from "vue";

const props = defineProps({
    fields: {
        type: Array,
        required: true
    }
});

const authors = computed(() => {
    let group = props.fields.filter((item) => {
        return item.type === 'author';
    });

    // TODO: trochę wymiękłem jak się dostać tutaj do tych elementów. Powyższy filter powinien zawsze odfiltrować tablicę
    // TODO: do jednego elementu, który zawiera pola type i fields
    return group.fields;
})
const reviewers = computed(() => {
    let group = props.fields.filter((item) => {
        return item.type === 'reviewer';
    });

    return group.fields;
})
const redactors = computed(() => {
    let group = props.fields.filter((item) => {
        return item.type === 'redactor';
    });

    return group.fields;
})

</script>

<template>
    <div>
        <h3>Autorzy:</h3>
        <div v-for="author in authors">
            {{ author }}
        </div>

        <h3>Redaktorzy:</h3>
        <div v-for="redactor in redactors">
            {{ redactor }}
        </div>

        <h3>Recenzenci:</h3>
        <div v-for="reviewer in reviewers">
            {{ reviewer }}
        </div>
    </div>
</template>
