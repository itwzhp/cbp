<script setup>
import { ref, watch } from 'vue';
import { router } from '@inertiajs/vue3';
import axios from 'axios';
import { usePage } from '@inertiajs/vue3';

const material = usePage().props.material;
const hardcodedLicences = [
  { id: 1, name: 'CC BY-NC-SA 3.0 PL' },
  { id: 2, name: 'ZHP' },
  { id: 3, name: 'CC BY 3.0 PL' },
];

const requestResultInfoTime = 5000;
let succesTimeout = null;
let errorTimeout = null;

const licence = ref(usePage().props.material.licence.id);
let lastSavedValue = licence.value;

const unSavedChanges = ref(false);
const savedChanges = ref(false);
const saveChangesError = ref(false);

watch(
  licence,
  (() => {
    axios
      .post(route('api.admin.materials.update', material.id), { licence_id: licence.value })
      .then(() => {
        savedChanges.value = true;
        unSavedChanges.value = false;
        lastSavedValue = licence.value;

        router.reload({ only: ['material'] });
        clearTimeout(succesTimeout);
        succesTimeout = setTimeout(() => {
          savedChanges.value = false;
        }, requestResultInfoTime);
      })
      .catch(() => {
        unSavedChanges.value = false;
        saveChangesError.value = true;
        licence.value = lastSavedValue;

        clearTimeout(errorTimeout);
        errorTimeout = setTimeout(() => {
          saveChangesError.value = false;
        }, requestResultInfoTime);
      });
  })
);

watch(licence, () => {
  unSavedChanges.value = true;
});
</script>

<template>
  <div class="flex justify-between text-sm font-semibold pb-2">
    <div>Licencja</div>
    <div class="cursor-pointer">
      <span
        v-if="savedChanges"
        class="text-green-600"
      >Zapisano wprowadzone zmiany</span>
      <span
        v-if="saveChangesError"
        class="text-red-600"
      >Wystąpił błąd! Zmiany nie zostały zapisane.</span>
      <span
        class="inline-flex max-h-6 items-center justify-center px-2 py-0.5 ml-3 text-sm font-bold text-gray-500 bg-gray-200 rounded"
      >-</span>
      <span class="flex-1 ml-3">Usuń sekcje</span>
    </div>
  </div>
  <div class="w-full bg-gray-50/50 bg-white border border-gray-200 rounded-lg p-3">
    <select
      id="countries"
      v-model="licence"
      class="bg-gray-50/50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
    >
      <option
        v-for="(hardcodedLicence, key) in hardcodedLicences"
      
        :key="key"
        :value="hardcodedLicence.id"
        :selected="material.licence.id === hardcodedLicence.id"
      >
        {{ hardcodedLicence.name }}
      </option>
    </select>
  </div>
</template>
