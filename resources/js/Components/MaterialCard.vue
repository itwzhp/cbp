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
    <div class="flex justify-center sm:p-1 md:p-2 lg:p-3 sm:w-1/2 md:w-1/3 lg:w-1/4">
        <div class="rounded-lg shadow-lg bg-white max-w-sm flex flex-col">
            <Link :href="route('materials.show', props.item.slug)" class="flex-1">
                <figure class="relative max-w transition-all duration-300 cursor-pointer">
                    <img class="rounded-t-lg" :src="props.item.thumb" :alt="props.item.title">
                    <figcaption v-if="props.item.thumb && props.item.type" class="absolute px-3 text-lg text-white top-1.5">
                        <span class="bg-zhp-500 text-white text-xs font-medium mr-2 px-2.5 py-0.5 rounded">
                            {{ props.item.type }}
                        </span>
                    </figcaption>
                </figure>
            </Link>
            <div class="p-3 flex flex-col justify-between flex-grow">
                <div>
                    <Link :href="route('materials.show', props.item.slug)">
                        <h5 class="mb-2 font-medium mt-1 text-xl font-bold text-gray-900 "> {{ props.item.title }}</h5>
                    </Link>
                </div>
                <div class="mb-2">
                    <div>
                        <i class="fa fa-user text-zhp-900"></i> {{ props.item.author }}
                    </div>
                    <p class="text-base text-gray-500 text-sm">
                        <i class="fa fa-calendar text-gray-500"></i>
                        {{ $filters.dateFormat(props.item.published_at) }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>
