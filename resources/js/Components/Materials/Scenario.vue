<script setup>

const props = defineProps({
    scenario: {
        type: Object,
        required: true
    },
    itemId: {
        type: Number
    }
});

</script>

<template>
    <div class="flex my-2 border-b border-gray-200">
        <div>
            <div class="rounded-full bg-gray-200 text-xl w-10 h-10 text-center flex-1">
                {{ itemId + 1 }}
            </div>
        </div>
        <div class="flex-grow px-2">
            <h5 class="font-bold">
                {{ scenario.title }}
            </h5>
            <div v-html="scenario.description"></div>
            <div class="flex">
                <div v-if="scenario.responsible" class="mt-3">
                    <span class="font-bold">Odpowiedzialny: </span> {{ scenario.responsible }}
                </div>
                <div v-if="scenario.materials" class="mt-3">
                    <span class="font-bold">Materiały: </span>{{ scenario.materials }}
                </div>
            </div>
        </div>
        <div class="flex-1">
            <span class="font-bold">{{ scenario.form }}</span>
            <span v-if="scenario.duration">
                {{ scenario.duration }} min.
            </span>
        </div>
    </div>
</template>
