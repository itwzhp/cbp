<script setup>
import { ref, watch } from 'vue';
import debounce from 'lodash.debounce';
import axios from 'axios';
import { usePage } from '@inertiajs/vue3';

const props = defineProps({
  fieldName: { type: String, required: true },
  fieldLabel: { type: String, required: true },
});
let timeout = null;
const emit = defineEmits(['valueSaved']);
const material = usePage().props.material;
const field = ref(usePage().props.material[props.fieldName]);
const unSavedChanges = ref(false);
const savedChanges = ref(false);

watch(
  field,
  debounce(() => {
    axios
      .post(`/api/admin/materials/${material.id}`, { [props.fieldName]: field.value })
      .then(() => {
        savedChanges.value = true;
        unSavedChanges.value = false;
        emit('valueSaved', field.value);
        clearTimeout(timeout);
        timeout = setTimeout(() => {
          savedChanges.value = false;
        }, 5000);
      })
      .catch(() => {
        unSavedChanges.value = false;
      });
  }, 1000)
);

watch(field, () => {
  unSavedChanges.value = true;
});
</script>

<template>
  <label
    :for="fieldLabel"
    class="block mb-1 text-sm font-medium text-gray-900"
  >
    <div class="flex justify-between ...">
      <div>{{ fieldLabel }}</div>
      <div>
        <span
          v-if="unSavedChanges"
          class="text-yellow-600"
        >Wprowadzono zmiany</span>
        <span
          v-if="savedChanges && !unSavedChanges"
          class="text-green-600"
        >Zapisano wprowadzone zmiany</span>
      </div>
    </div>
  </label>
  <input
    :id="fieldLabel"
    v-model="field"
    type="text"
    :class="{
      'focus:ring-yellow-400 focus:border-yellow-400': unSavedChanges,
      'focus:ring-green-400 focus:border-green-400': savedChanges && !unSavedChanges,
    }"
    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
    :placeholder="fieldLabel"
    required
  >
</template>
