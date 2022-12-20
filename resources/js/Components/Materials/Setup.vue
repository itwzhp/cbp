<script setup>
const props = defineProps({
    setup: {
        type: Object,
        required: true
    }
});

const keyToText = {
    capacity_min: "Minimalna liczba uczestników",
    capacity_opt: "Optymalna liczba uczestników",
    capacity_max: "Maksymalna liczba uczestników",
    duration: "Czas trwania",
    time: "Pora dnia",
    instructor_count: "Wymagana liczba instruktorów",
    instructor_competence: "Wymagania dla prowadzącego",
    remarks: "Uwagi",
    location: "Lokalizacja",
    technical_requirements: "Wymagania techniczne",
    materials: "Materiały",
    participant_materials: "Materiały uczestnika",
    participant_clothing: "Ubiór uczestnika",
}

</script>

<template>
    <div class="columns-2">
        <div v-for="(item, key) in setup" :key="key">
            <span class="font-bold">{{ keyToText[key] }}: </span> {{ item }}
        </div>
    </div>
</template>
