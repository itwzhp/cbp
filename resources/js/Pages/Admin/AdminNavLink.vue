<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps(['href', 'icon']);

const classes = computed(() =>
  route().current(props.href)
    ? {
        container:
          'bg-cbp-100 flex items-center p-2 text-base font-normal text-gray-900 rounded-lg',
        svg: 'w-6 h-6 text-white',
        text: 'ml-3 text-white',
      }
    : {
        container:
          'flex items-center p-2 text-base font-normal text-gray-900 rounded-lg hover:bg-cbp-100/75 not-active',
        svg: 'w-6 h-6 text-gray-500',
        text: 'ml-3',
      }
);
</script>

<template>
  <Link :href="route(href)">
    <div :class="classes.container">
      <font-awesome-icon
        :class="classes.svg"
        :icon="props.icon"
      />
      <span :class="classes.text">
        <slot />
      </span>
    </div>
  </Link>
</template>
<style>
:hover.not-active svg {
  color: white;
}

:hover.not-active span {
  color: white;
}
</style>
