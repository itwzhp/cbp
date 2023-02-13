<script setup>
import { Link } from '@inertiajs/vue3';
const props = defineProps({
  topic: { type: Object, required: true },
});
</script>

<template>
  <Link
    :href="topic.url"
    class="h-20 flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100"
  >
    <div class="ml-3 hidden md:block">
      <div class="relative w-12 h-12 overflow-hidden bg-gray-300 rounded-full"></div>
    </div>
    <div class="flex flex-col justify-between p-4 leading-normal mt-2 md:mt-0">
      <h5 class="text-xl font-bold tracking-tight text-gray-900">{{ topic.name }}</h5>
    </div>
  </Link>
</template>
