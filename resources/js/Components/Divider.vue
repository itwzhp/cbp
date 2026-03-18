<script setup>
const props = defineProps(['classes']);
</script>

<template>
  <div
    class="bg-gray-100 py-1"
    :class="classes"
  >
    <h3 class="text-sm font-medium leading-5 text-gray-600 px-2 ">
      <slot />
    </h3>
  </div>
</template>
