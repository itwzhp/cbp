<script setup>
import {Link} from "@inertiajs/inertia-vue3";

const props = defineProps({
    taxonomy: {type: Object, required: true}
});

</script>

<template>
    <div class="flex m-2">
        <div class="rounded-l bg-zhp-700 text-white p-1 text-sm font-bold flex flex-col justify-center">
            <p>{{ taxonomy.taxonomy_name }}:</p>
        </div>
        <div class="rounded-r border border-zhp-700 text-gray-900 text-sm p-1 flex justify-center">
            <!-- // TODO: żeby ten border-r nie był widoczny na ostatnim elemencie -->
            <Link
                v-for="tag in taxonomy.tags"
                :href="route('materials.tag', tag.slug )"
                class="px-2 border-r"
            >
                {{ tag.name }}
            </Link>
        </div>
    </div>
</template>
