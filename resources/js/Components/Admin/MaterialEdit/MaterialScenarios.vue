<script setup>
import { router } from '@inertiajs/vue3';
import { ref } from 'vue';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import axios from 'axios';
import ContentAccess from '@/Components/Admin/ContentAccess.vue';
import MaterialScenarioDetails from '@/Components/Admin/MaterialEdit/MaterialScenarioDetails.vue';
import { permissions } from '@/Components/Admin/permissions.js';

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

const scenarioDetailsChanged = (savedSuccessfully) => {
  return savedSuccessfully ? successInfo() : errorInfo();
};

const refreshScenarios = () => {
  router.reload({ only: ['material'] });
};

const expandedScenarioDetailsIds = ref([]);
const expandScenarioDetails = (id) => {
  if (expandedScenarioDetailsIds.value.includes(id)) {
    expandedScenarioDetailsIds.value = expandedScenarioDetailsIds.value.filter(
      (scenarioDetailsIndex) => scenarioDetailsIndex !== id
    );
  } else {
    expandedScenarioDetailsIds.value.push(id);
  }
};
const isScenarioDetailsExpanded = (id) => {
  return expandedScenarioDetailsIds.value.includes(id);
};

const deleteInProgressScenarioIndex = ref(null);
const deleteScenario = (scenario, index) => {
  deleteInProgressScenarioIndex.value = index;
  axios
    .delete(
      route('api.admin.materials.scenarios.destroy', {
        material: scenario.material_id,
        scenario: scenario.id,
      })
    )
    .then(() => {
      deleteInProgressScenarioIndex.value = null;
      successInfo();
      refreshScenarios();
    })
    .catch(() => {
      errorInfo();
      deleteInProgressScenarioIndex.value = null;
    });
};

const createScenarioInProgress = ref(null);
const createScenario = (material) => {
  createScenarioInProgress.value = true;
  axios
    .post(
      route(
        'api.admin.materials.scenarios.store',
        {
          material
        },
        {
          title: 'Nowy scenariusz',
          order: 0,
          description: null,
          form: null,
          materials: null,
          responsible: null,
          duration: null,
        }
      )
    )
    .then(() => {
      createScenarioInProgress.value = null;
      successInfo();
      refreshScenarios();
    })
    .catch(() => {
      errorInfo();
      createScenarioInProgress.value = null;
    });
};

const sortScenarios = (scenarios) => {
  return scenarios.sort((a, b) => a.order - b.order);
};
</script>
<template>
  <div class="flex justify-between text-sm font-semibold pb-2">
    <div>Scenariusze</div>
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
      class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded text-sm"
      :class="{ 'opacity-50 cursor-wait': createScenarioInProgress }"
      :disabled="createScenarioInProgress"
      @click.prevent="createScenario($page.props.material)"
    >
      Dodaj scenariusz
    </button>
    <ul
      class="space-y-3"
      :class="{ 'my-4': $page.props.material.scenarios?.length }"
    >
      <li
        v-for="scenario in sortScenarios($page.props.material.scenarios)"
        :key="scenario.id"
      >
        <div
          class="md:flex justify-between text-sm p-2 text-base font-medium text-gray-900 rounded-lg bg-gray-100 group hover:shadow"
          :class="{ 'rounded-b-none': isScenarioDetailsExpanded(scenario.id) }"
        >
          <div class="md:flex items-center">
            <p
              title="Szczegóły scenariusza"
              class="mb-1 cursor-pointer font-semibold"
              @click="expandScenarioDetails(scenario.id)"
            >
              {{ scenario.title || 'Nowy scenariusz' }}
              <button class="text-xs px-1">
                <FontAwesomeIcon
                  v-if="!isScenarioDetailsExpanded(scenario.id)"
                  icon="chevron-down"
                />
                <FontAwesomeIcon
                  v-if="isScenarioDetailsExpanded(scenario.id)"
                  icon="chevron-up"
                />
              </button>
            </p>
          </div>
          <div class="md:flex items-center">
            <ContentAccess :permissions="[permissions.UPDATE]">
              <button
                title="Usuń scenariusz"
                :disabled="deleteInProgressScenarioIndex === scenario.id"
                :class="{
                  'bg-red-500/50 hover:bg-red-500/50 cursor-wait':
                    deleteInProgressScenarioIndex === scenario.id,
                }"
                class="bg-red-500 hover:bg-red-700 text-white py-2 px-4 rounded text-xs mx-2"
                @click.prevent="deleteScenario(scenario, scenario.id)"
              >
                <FontAwesomeIcon icon="trash" />
              </button>
            </ContentAccess>
          </div>
        </div>
        <ContentAccess :permissions="[permissions.UPDATE]">
          <MaterialScenarioDetails
            v-if="isScenarioDetailsExpanded(scenario.id)"
            class="bg-gray-100 py-3 rounded-b-lg"
            :scenario="scenario"
            @save-success="scenarioDetailsChanged(true)"
            @save-error="scenarioDetailsChanged(false)"
          />
        </ContentAccess>
      </li>
    </ul>
  </div>
</template>
