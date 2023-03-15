<script setup>
import { router } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import debounce from 'lodash.debounce';
import axios from 'axios';
import ContentAccess from '@/Components/Admin/ContentAccess.vue';
import { permissions } from '@/Components/Admin/permissions.js';

const props = defineProps({
  scenario: { type: Object, required: true }
});
const emit = defineEmits(['saveSuccess', 'saveError']);

const inputClasses = 'bg-gray-50/50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mb-2';

const title = ref(props.scenario.title);
const order = ref(props.scenario.order);
const description = ref(props.scenario.description);
const form = ref(props.scenario.form);
const materials = ref(props.scenario.materials);
const responsible = ref(props.scenario.responsible);
const duration = ref(props.scenario.duration);

const refreshScenarios = () => {
  router.reload({ only: ['material'] });
};

watch(
  [title, description, form, materials, responsible, duration, order],
  debounce(() => {
    updateScenario();
  }, 1000)
);

const updateScenario = () => {
  axios
    .post(
      route('api.admin.materials.scenarios.update', {
        material: props.scenario.material_id,
        scenario: props.scenario.id,
      }),
      {
        title: title.value,
        order: order.value,
        description: description.value,
        form: form.value,
        materials: materials.value,
        responsible: responsible.value,
        duration: duration.value
      }
    )
    .then(() => {
      emit('saveSuccess');
      refreshScenarios();
    })
    .catch(() => {
      emit('saveError');
      refreshScenarios();
    });
};
</script>
<template>
  <div class="w-full px-2">
    <div>
      <ContentAccess :permissions="[permissions.UPDATE]">
        <label
          for="title"
          class="block mb-1 text-sm font-medium text-gray-900"
        >Tytuł</label>
        <input
          id="title"
          v-model="title"
          type="text"
          :class="inputClasses"
          placeholder="Nazwa elementu zajęć"
          required
        >
        <label
          for="order"
          class="block mb-1 text-sm font-medium text-gray-900"
        >Kolejność</label>
        <input
          id="order"
          v-model="order"
          type="number"
          :class="inputClasses"
          placeholder="Kolejność"
          required
        >
        <label
          for="description"
          class="block mb-1 text-sm font-medium text-gray-900"
        >Opis elementu</label>
        <input
          id="description"
          v-model="description"
          type="text"
          :class="inputClasses"
          placeholder="Opis"
          required
        >
        <label
          for="form"
          class="block mb-1 text-sm font-medium text-gray-900"
        >Forma zajęć</label>
        <input
          id="form"
          v-model="form"
          type="text"
          :class="inputClasses"
          placeholder="Forma"
          required
        >
        <label
          for="materials"
          class="block mb-1 text-sm font-medium text-gray-900"
        >Potrzebne materiały</label>
        <input
          id="materials"
          v-model="materials"
          type="text"
          :class="inputClasses"
          placeholder="Materiały"
          required
        >
        <label
          for="responsible"
          class="block mb-1 text-sm font-medium text-gray-900"
        >Odpowiedzialna osoba</label>
        <input
          id="responsible"
          v-model="responsible"
          type="text"
          :class="inputClasses"
          placeholder="Osoba odpowiedzialna"
          required
        >
        <label
          for="duration"
          class="block mb-1 text-sm font-medium text-gray-900"
        >Czas trwania</label>
        <input
          id="duration"
          v-model="duration"
          type="text"
          :class="inputClasses"
          placeholder="Czas trwania"
          required
        >
      </ContentAccess>
    </div>
  </div>
</template>
