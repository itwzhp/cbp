<script setup>
import { usePage } from '@inertiajs/vue3';

const material = usePage().props.material;
const hardcodedLicences = [
  { id: 1, name: 'CC BY-NC-SA 3.0 PL' },
  { id: 2, name: 'ZHP' },
  { id: 3, name: 'CC BY 3.0 PL' },
];
</script>

<template>
  <label
    for="countries"
    class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white"
  ><div class="flex justify-between">
    <div>Licencja</div>
    <div class="cursor-pointer">
      <span
        class="inline-flex max-h-6 items-center justify-center px-2 py-0.5 ml-3 text-sm font-bold text-gray-500 bg-gray-200 rounded"
      >-</span>
      <span class="flex-1 ml-3">Usuń sekcje</span>
    </div>
  </div></label>
  <select
    id="countries"
    class="bg-gray-50/50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
  >
    <option
      v-for="(licence, key) in hardcodedLicences"
      :key="key"
      :value="licence.id"
      :selected="material.licence.id === licence.id"
    >
      {{ licence.name }}
    </option>
  </select>
</template>
