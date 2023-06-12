<script setup>
import { computed } from 'vue';

const props = defineProps(['active']);

const classes = computed(() =>
  props.active
    ? 'inline-flex text-center pb-[18px] cursor-pointer items-center px-1 pt-5 border-b-2 border-cbp-400 text-sm font-medium leading-6 text-gray-900 focus:outline-none focus:border-cbp-700 transition  duration-150 ease-in-out'
    : 'inline-flex text-center pb-[18px] cursor-pointer items-center px-1 pt-5 border-b-2 border-transparent text-sm font-medium leading-6 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out'
);
</script>

<template>
  <a
    :class="classes"
    type="button"
  >
    <slot />
  </a>
</template>
