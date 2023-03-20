<script setup>
import { ref, watch } from 'vue';
import debounce from 'lodash.debounce';
import axios from 'axios';
import ContentAccess from '@/Components/Admin/ContentAccess.vue';
import { permissions } from '@/Components/Admin/permissions.js';

const props = defineProps({
  setup: { type: Object, required: true },
});
const emit = defineEmits(['saveSuccess', 'saveError']);

const inputClasses =
  'border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mb-2';

const capacity_min = ref(props.setup.capacity_min);
const capacity_opt = ref(props.setup.capacity_opt);
const capacity_max = ref(props.setup.capacity_max);
const duration = ref(props.setup.duration);
const time = ref(props.setup.time);
const instructor_count = ref(props.setup.instructor_count);
const instructor_competence = ref(props.setup.instructor_competence);
const remarks = ref(props.setup.remarks);
const location = ref(props.setup.location);
const technical_requirements = ref(props.setup.technical_requirements);
const materials = ref(props.setup.materials);
const participant_materials = ref(props.setup.participant_materials);
const participant_clothing = ref(props.setup.participant_clothing);

watch(
  [
    capacity_min,
    capacity_opt,
    capacity_max,
    duration,
    time,
    instructor_count,
    instructor_competence,
    remarks,
    location,
    technical_requirements,
    materials,
    participant_materials,
    participant_clothing,
  ],
  debounce(() => {
    updateAttachment();
  }, 1000)
);

const updateAttachment = () => {
  console.log(props.materialId);
  axios
    .post(
      route('api.admin.materials.setups.update', {
        material: props.setup.material_id,
        setup: props.setup.id,
      }),
      {
        capacity_min: capacity_min.value,
        capacity_opt: capacity_opt.value,
        capacity_max: capacity_max.value,
        duration: duration.value,
        time: time.value,
        instructor_count: instructor_count.value,
        instructor_competence: instructor_competence.value,
        remarks: remarks.value,
        location: location.value,
        technical_requirements: technical_requirements.value,
        materials: materials.value,
        participant_materials: participant_materials.value,
        participant_clothing: participant_clothing.value,
      }
    )
    .then(() => {
      emit('saveSuccess');
    })
    .catch(() => {
      emit('saveError');
    });
};
</script>
<template>
  <div class="w-full">
    <div>
      <ContentAccess :permissions="[permissions.UPDATE]">
        <label
          for="capacity_min"
          class="block mb-1 text-sm font-medium text-gray-900"
        >Liczba uczestników - min</label>
        <input
          id="capacity_min"
          v-model="capacity_min"
          type="number"
          :class="inputClasses"
          placeholder="Liczba uczestników - min"
          required
        >
        <label
          for="capacity_opt"
          class="block mb-1 text-sm font-medium text-gray-900"
        >Liczba uczestników - opt</label>
        <input
          id="capacity_opt"
          v-model="capacity_opt"
          type="number"
          :class="inputClasses"
          placeholder="Liczba uczestników - opt"
          required
        >
        <label
          for="capacity_max"
          class="block mb-1 text-sm font-medium text-gray-900"
        >Liczba uczestników - maks</label>
        <input
          id="capacity_max"
          v-model="capacity_max"
          type="number"
          :class="inputClasses"
          placeholder="Liczba uczestników - maks"
          required
        >
        <label
          for="duration"
          class="block mb-1 text-sm font-medium text-gray-900"
        >Czas trwania</label>
        <input
          id="duration"
          v-model="duration"
          type="number"
          :class="inputClasses"
          placeholder="Czas trwania"
          required
        >
        <label
          for="time"
          class="block mb-1 text-sm font-medium text-gray-900"
        >Pora dnia</label>
        <input
          id="time"
          v-model="time"
          type="text"
          :class="inputClasses"
          placeholder="Pora dnia"
          required
        >
        <label
          for="instructor_count"
          class="block mb-1 text-sm font-medium text-gray-900"
        >Liczba instruktorów</label>
        <input
          id="instructor_count"
          v-model="instructor_count"
          type="number"
          :class="inputClasses"
          placeholder="Liczba instruktorów"
          required
        >
        <label
          for="instructor_competence"
          class="block mb-1 text-sm font-medium text-gray-900"
        >Wymagania dla instruktorów</label>
        <input
          id="instructor_competence"
          v-model="instructor_competence"
          type="text"
          :class="inputClasses"
          placeholder="Wymagania dla instruktorów"
          required
        >
        <label
          for="remarks"
          class="block mb-1 text-sm font-medium text-gray-900"
        >Uwagi</label>
        <input
          id="remarks"
          v-model="remarks"
          type="text"
          :class="inputClasses"
          placeholder="Uwagi"
          required
        >
        <label
          for="location"
          class="block mb-1 text-sm font-medium text-gray-900"
        >Lokalizacja</label>
        <input
          id="location"
          v-model="location"
          type="text"
          :class="inputClasses"
          placeholder="Lokalizacja"
          required
        >
        <label
          for="technical_requirements"
          class="block mb-1 text-sm font-medium text-gray-900"
        >Wymagania techniczne</label>
        <input
          id="technical_requirements"
          v-model="technical_requirements"
          type="text"
          :class="inputClasses"
          placeholder="Wymagania techniczne"
          required
        >
        <label
          for="materials"
          class="block mb-1 text-sm font-medium text-gray-900"
        >Materiały</label>
        <input
          id="materials"
          v-model="materials"
          type="text"
          :class="inputClasses"
          placeholder="Materiały"
          required
        >
        <label
          for="participant_materials"
          class="block mb-1 text-sm font-medium text-gray-900"
        >Materiały uczestnika</label>
        <input
          id="participant_materials"
          v-model="participant_materials"
          type="text"
          :class="inputClasses"
          placeholder="Materiały uczestnika"
          required
        >
        <label
          for="participant_clothing"
          class="block mb-1 text-sm font-medium text-gray-900"
        >Ubiór uczestnika</label>
        <input
          id="participant_clothing"
          v-model="participant_clothing"
          type="text"
          :class="inputClasses"
          placeholder="Ubiór uczestnika"
          required
        >
      </ContentAccess>
    </div>
  </div>
</template>
