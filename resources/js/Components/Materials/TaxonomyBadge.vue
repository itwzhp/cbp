<script setup>
import {Link} from "@inertiajs/vue3";

const props = defineProps({
    taxonomy: {type: Object, required: true}
});

</script>

<template>
    <div class="md:flex mb-2">
        <div class="rounded-t-xl md:rounded-tr-none md:rounded-l-xl bg-zhp-700 text-white p-2 pl-3 pr-3 text-sm font-bold flex min-w-fit items-center">
            <p>{{ taxonomy.taxonomy_name }}:</p>
        </div>
        <div class="rounded-b-xl md:rounded-bl-none md:rounded-r-xl border border-zhp-700 text-gray-900 text-sm p-2">
            <Link
                v-for="tag in taxonomy.tags"
                :href="route('materials.tag', tag.slug )"
                class="px-2 py-0.5 border-r last:border-none inline-block"
            >
                {{ tag.name }}
            </Link>
        </div>
    </div>
</template>
