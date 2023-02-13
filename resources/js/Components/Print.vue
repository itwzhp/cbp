<script setup>
const print = () => {
  window.print();
};
</script>

<template>
  <div class="cursor-pointer print:hidden" @click.prevent="print()">
    <slot />
  </div>
</template>
