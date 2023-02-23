<script setup>
import { usePage } from '@inertiajs/vue3';

const material = usePage().props.material;
const filterFields = (fields) => {
  return fields.filter((group) => group.type === 'author');
};
</script>

<template>
  <p class="block mb-1 text-sm font-medium text-gray-900">
    Autorzy
  </p>
  <div class="w-full bg-gray-50/50 bg-white border border-gray-200 rounded-lg p-3">
    <div
      v-for="(field, key) in filterFields(material.fields)"
      :key="key"
    >
      {{ field.type }},
      {{ field.value }}
    </div>
  </div>
</template>
