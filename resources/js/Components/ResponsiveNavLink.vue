<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps(['href', 'active', 'block']);

const classes = computed(() => props.active
  ? 'block pl-3 pr-4 py-2 border-l-4 border-cbp-400 text-base font-medium text-cbp-700 bg-cbp-50 focus:outline-none focus:text-cbp-800 focus:bg-cbp-100 focus:border-cbp-700 transition duration-150 ease-in-out'
  : 'block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out'
);
</script>

<template>
  <Link :href="href || ''" :class="`${classes} ${block && 'pointer-events-none'}`">
  <slot />
  </Link>
</template>
