<script setup>

const props = defineProps({
    licence: {
        type: Object,
        required: true,
    }
});

</script>
<template>
    <div>
        <h3 class="font-bold text-lg">Licencja materiału</h3>
        <a v-if="licence.url" :href="licence.url" target="_blank">{{ licence.name }}</a>
        <span v-else>{{ licence.name }}</span>
    </div>
</template>
