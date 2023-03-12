<script setup>
import { router } from '@inertiajs/vue3';
import { ref } from 'vue';
import axios from 'axios';
import MaterialSetupDetails from '@/Components/Admin/MaterialEdit/MaterialSetupDetails.vue';

const requestResultInfoTime = 5000;
const savedChanges = ref(false);
const saveChangesError = ref(false);
let successTimeout = null;
let errorTimeout = null;

const successInfo = () => {
  saveChangesError.value = false;
  savedChanges.value = true;
  clearTimeout(successTimeout);
  successTimeout = setTimeout(() => {
    savedChanges.value = false;
  }, requestResultInfoTime);
};

const errorInfo = () => {
  savedChanges.value = false;
  saveChangesError.value = true;
  clearTimeout(errorTimeout);
  errorTimeout = setTimeout(() => {
    saveChangesError.value = false;
  }, requestResultInfoTime);
};

const setupDetailsChanged = (savedSuccessfully) => {
  return savedSuccessfully ? successInfo() : errorInfo();
};

const refreshMaterial = () => {
  router.reload({ only: ['material'] });
};

const addSetup = (materialId) => {
  axios
    .post(route('api.admin.materials.setups.store', { material: materialId }), {
      capacity_min: null,
      capacity_opt: null,
      capacity_max: null,
      duration: null,
      time: null,
      instructor_count: null,
      instructor_competence: null,
      remarks: null,
      location: null,
      technical_requirements: null,
      materials: null,
      participant_materials: null,
      participant_clothing: null,
    })
    .then(() => {
      successInfo();
      refreshMaterial();
    })
    .catch(() => {
      errorInfo();
      refreshMaterial();
    });
};
</script>
<template>
  <div class="flex justify-between text-sm font-semibold pb-2">
    <div>Wymagania organizacyjne</div>
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
    <button
      v-if="!$page.props.material.setups?.length"
      class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-3 rounded text-sm mx-2"
      @click="addSetup($page.props.material.id)"
    >
      + Dodaj wymagania
    </button>
    <ul>
      <li
        v-for="setup in $page.props.material.setups"
        :key="setup.id"
      >
        <MaterialSetupDetails
          v-if="$page.props.material.setups?.length"
          :setup="setup"
          @save-success="setupDetailsChanged(true)"
          @save-error="setupDetailsChanged(false)"
        />
      </li>
    </ul>
  </div>
</template>
