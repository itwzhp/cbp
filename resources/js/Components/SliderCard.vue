<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps({
  slide: { type: Object, required: true }
});

</script>
<template>
  <!-- scale-95 hover:scale-100 hover:transition-transform -->
  <Link :href="route('materials.show', props.slide.url)" class="flex-1">
    <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
      <div>
        <img class="rounded-t-lg" :src="slide.image" :alt="slide.image" />
      </div>
      <div class="p-5">
        <p class="mb-3 font-normal text-base text-gray-700">Some text...</p>
      </div>
    </div>
  </Link>
</template>
