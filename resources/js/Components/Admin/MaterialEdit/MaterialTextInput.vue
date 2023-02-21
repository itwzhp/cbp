<script setup>
import { ref, watch } from 'vue';
import debounce from 'lodash.debounce';
import axios from 'axios';
import { usePage } from '@inertiajs/vue3';

const props = defineProps({
  fieldName: { type: String, required: true },
  fieldLabel: { type: String, required: true },
});
const emit = defineEmits(['valueSaved']);

const requestResultInfoTime = 5000;
const inputDebounceTime = 1000;
let succesTimeout = null;
let errorTimeout = null;

const material = usePage().props.material;
const field = ref(usePage().props.material[props.fieldName]);
let lastSavedValue = field.value;

const unSavedChanges = ref(false);
const savedChanges = ref(false);
const saveChangesError = ref(false);

watch(
  field,
  debounce(() => {
    axios
      .post(`/api/admin/materials/${material.id}`, { [props.fieldName]: field.value })
      .then(() => {
        savedChanges.value = true;
        unSavedChanges.value = false;
        lastSavedValue = field.value;

        emit('valueSaved', field.value);
        clearTimeout(succesTimeout);
        succesTimeout = setTimeout(() => {
          savedChanges.value = false;
        }, requestResultInfoTime);
      })
      .catch(() => {
        unSavedChanges.value = false;
        saveChangesError.value = true;
        field.value = lastSavedValue;

        clearTimeout(errorTimeout);
        errorTimeout = setTimeout(() => {
          saveChangesError.value = false;
        }, requestResultInfoTime);
      });
  }, inputDebounceTime)
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
    <div class="flex justify-between">
      <div>{{ fieldLabel }}</div>
      <div>
        <span
          v-if="unSavedChanges && !saveChangesError"
          class="text-yellow-600"
        >Wprowadzono zmiany</span>
        <span
          v-if="savedChanges && !unSavedChanges"
          class="text-green-600"
        >Zapisano wprowadzone zmiany</span>
        <span
          v-if="saveChangesError"
          class="text-red-600"
        >Wystąpił błąd! Zmiany nie zostały zapisane.</span>
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
      'focus:ring-red-400 focus:border-red-400': saveChangesError
    }"
    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
    :placeholder="fieldLabel"
    required
  >
</template>
