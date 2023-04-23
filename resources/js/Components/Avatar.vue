<script setup>
import { computed } from 'vue';

const props = defineProps({
  imgSrc: { type: String },
  height: { type: Number },
  width: { type: Number },
  tooltip: { type: String },
});
const classes = computed(() =>
  props.imgSrc?.length
    ? `w-${props.width || 12} h-${props.height || 12} rounded`
    : `relative w-${props.width || 12} h-${
        props.height || 12
      } overflow-hidden bg-gray-100 rounded-full`
);
const svgClasses = computed(
  () =>
    `absolute w-${props.width + 2 || 14} h-${
      props.height + 2 || 14
    } text-gray-400 -left-1`
);
</script>

<template>
  <div>
    <template v-if="props.imgSrc?.length">
      <img
        :class="classes"
        :src="props.imgSrc"
        :alt="tooltip ?? 'avatar'"
      >
    </template>
    <template v-else>
      <div :class="classes">
        <svg
          :class="svgClasses"
          fill="currentColor"
          viewBox="0 0 20 20"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            fill-rule="evenodd"
            d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
            clip-rule="evenodd"
          />
        </svg>
      </div>
    </template>
  </div>
</template>
