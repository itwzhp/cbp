<script setup>
import { router } from '@inertiajs/vue3';
import { ref } from 'vue';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import axios from 'axios';
import ContentAccess from '@/Components/Admin/ContentAccess.vue';
import MaterialFieldDetails from '@/Components/Admin/MaterialEdit/MaterialFieldDetails.vue';
import { permissions } from '@/Components/Admin/permissions.js';

const props = defineProps({
  type: { type: String, required: true },
});

const types = new Map([
  [
    'intent',
    {
      sectionRemovable: true,
      sectionDescription: 'Cele i zamierzenia',
      addTypeLabel: 'Dodaj cel lub zamierzenie',
    },
  ],
  [
    'scope',
    {
      sectionRemovable: true,
      sectionDescription: 'Zakres tematyczny',
      addTypeLabel: 'Dodaj zakres tematyczny',
    },
  ],
  [
    'requirement',
    {
      sectionRemovable: true,
      sectionDescription: 'Realizowane wymagania z instrumentów metodycznych',
      addTypeLabel: 'Dodaj wymaganie',
    },
  ],
  [
    'author',
    {
      sectionRemovable: false,
      sectionDescription: 'Autorzy',
      addTypeLabel: 'Dodaj autora',
    },
  ],
]);

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

const fieldDetailsChanged = (savedSuccessfully) => {
  return savedSuccessfully ? successInfo() : errorInfo();
};

const refreshFields = () => {
  router.reload({ only: ['material'] });
};

const deleteInProgressFieldIndex = ref(null);
const deleteScenario = (field, index) => {
  deleteInProgressFieldIndex.value = index;
  axios
    .delete(
      route('api.admin.materials.fields.destroy', {
        material: field.material_id,
        field: field.id,
      })
    )
    .then(() => {
      deleteInProgressFieldIndex.value = null;
      successInfo();
      refreshFields();
    })
    .catch(() => {
      errorInfo();
      deleteInProgressFieldIndex.value = null;
    });
};

const createFieldInProgress = ref(null);
const createField = (material) => {
  createFieldInProgress.value = true;
  axios
    .post(
      route('api.admin.materials.fields.store', { material }),
      { value: '', type: props.type }
    )
    .then(() => {
      createFieldInProgress.value = null;
      successInfo();
      refreshFields();
    })
    .catch(() => {
      errorInfo();
      createFieldInProgress.value = null;
    });
};

const filterFields = (fields) => {
  return fields ? fields.filter((field) => field.type === props.type) : [];
};
</script>
<template>
  <div class="flex justify-between text-sm font-semibold pb-2">
    <div>{{ types.get(props.type)?.sectionDescription }}</div>
    <div class="cursor-pointer">
      <span
        v-if="savedChanges"
        class="text-green-600"
      >Zapisano wprowadzone zmiany</span>
      <span
        v-if="saveChangesError"
        class="text-red-600"
      >Wystąpił błąd! Zmiany nie zostały zapisane.</span>
      <template v-if="types.get(props.type)?.sectionRemovable">
        <span
          class="inline-flex max-h-6 items-center justify-center px-2 py-0.5 ml-3 text-sm font-bold text-gray-500 bg-gray-200 rounded"
        >-</span>
        <span class="flex-1 ml-3">Usuń sekcje</span>
      </template>
    </div>
  </div>
  <div class="w-full bg-gray-50/50 bg-white border border-gray-200 rounded-lg p-3">
    <button
      class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded text-sm"
      :class="{ 'opacity-50 cursor-wait': createFieldInProgress }"
      :disabled="createFieldInProgress"
      @click.prevent="createField($page.props.material)"
    >
      {{ types.get(props.type)?.addTypeLabel }}
    </button>
    <ul
      class="space-y-3"
      :class="{ 'my-4': filterFields($page.props.material.fields).length }"
    >
      <li
        v-for="field in filterFields($page.props.material.fields)"
        :key="field.id"
      >
        <div
          class="md:flex justify-between text-sm p-2 text-base font-medium text-gray-900 rounded-lg bg-gray-100 group hover:shadow"
        >
          <div class="md:flex items-center basis-full">
            <ContentAccess :permissions="[permissions.UPDATE]">
              <MaterialFieldDetails
                class="bg-gray-100 py-3 rounded-b-lg"
                :field="field"
                @save-success="fieldDetailsChanged(true)"
                @save-error="fieldDetailsChanged(false)"
              />
              <button
                title="Usuń scenariusz"
                :disabled="deleteInProgressFieldIndex === field.id"
                :class="{
                  'bg-red-500/50 hover:bg-red-500/50 cursor-wait':
                    deleteInProgressFieldIndex === field.id,
                }"
                class="bg-red-500 hover:bg-red-700 text-white py-2 px-4 rounded text-xs mx-2"
                @click.prevent="deleteScenario(field, field.id)"
              >
                <FontAwesomeIcon icon="trash" />
              </button>
            </ContentAccess>
          </div>
        </div>
      </li>
    </ul>
  </div>
</template>
