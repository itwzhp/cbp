<script setup>
// import { usePage } from '@inertiajs/vue3';

// const material = usePage().props.material;
</script>

<template>
  <p class="block mb-1 text-sm font-medium text-gray-900">
    Tagi
  </p>
  <div class="w-full bg-gray-50/50 bg-white border border-gray-200 rounded-lg p-3">
    <div
      v-for="(tag, key) in [1, 2, 3]"
      :key="key"
    >
      {{ `${tag} tag` }}
    </div>
  </div>
</template>
