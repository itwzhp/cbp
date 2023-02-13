<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
  slide: { type: Object, required: true },
});
</script>
<template>
  <!-- scale-95 hover:scale-100 hover:transition-transform -->
  <Link
    :href="props.slide.url"
    class="flex-1 h-full"
  >
    <div
      class="max-w-full sm:max-w-sm h-full bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100"
    >
      <div>
        <img
          class="w-full rounded-t-lg"
          :src="slide.thumb"
          :alt="slide.title"
        >
      </div>
      <div class="p-5">
        <p class="mb-3 font-normal text-base text-gray-700 text-left">
          {{ slide.title }}
        </p>
      </div>
    </div>
  </Link>
</template>
