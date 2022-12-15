<script setup>
import {Link} from "@inertiajs/inertia-vue3";

const props = defineProps({
    item: {type: Object, required: true}
})

const truncateText = (text, length, suffix) => {
    if (text.length > length) {
        return text.substring(0, length) + suffix;
    } else {
        return text;
    }
};

</script>
<template>
    <div class="p-1 sm:p-1 md:p-2 lg:p-3 sm:w-1/2 md:w-1/3 lg:w-1/4">
        <div class="h-full w-full mb-3 bg-white border rounded-lg shadow-md flex flex-col justify-between p-2">
            <h5 class="mb-3 mt-1 text-3xl font-bold text-gray-900 "> {{ props.item.title }}</h5>
            <div class=" mb-2">
                <a :href="route('materials.owner', props.item.owner.id)"
                   class="text-base text-gray-500 sm:text-lg">
                    <img class="rounded-full w-5 inline-block" alt="Awatar" :src=" props.item.owner.avatar ">
                    {{ props.item.owner.name }}
                </a>
                <p class="text-base text-gray-500 text-sm">
                    Opublikowano:
                    {{ $filters.dateFormat(props.item.published_at) }}
                </p>
            </div>
        </div>
    </div>
</template>
