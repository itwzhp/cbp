<script setup>
import {Link} from "@inertiajs/inertia-vue3";
import TaxonomyBadge from "@/Components/TaxonomyBadge.vue";

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
    <div class="w-full mb-3 bg-white border rounded-lg shadow-md sm:p-1 md:p-2 lg:p-3">
        <Link :href="route('materials.show', props.item.slug)">
            <h5 class="mb-5 mt-3 text-3xl font-bold text-gray-900 "> {{ props.item.title }}</h5>
        </Link>
        <div class="flex justify-between flex-col sm:flex-row mb-2">
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
        <div v-html="props.item.content" class="mb-3 p-2">
        </div>
        <div class="sm:flex flex-wrap">
            <TaxonomyBadge
                v-for="(item, index) in props.item.taxonomies"
                :key="index"
                :taxonomy="item"
            ></TaxonomyBadge>
        </div>
    </div>
</template>
