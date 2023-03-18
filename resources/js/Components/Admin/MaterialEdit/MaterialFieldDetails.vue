<script setup>
import { router } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import debounce from 'lodash.debounce';
import axios from 'axios';
import ContentAccess from '@/Components/Admin/ContentAccess.vue';
import { permissions } from '@/Components/Admin/permissions.js';

const props = defineProps({
  field: { type: Object, required: true }
});
const emit = defineEmits(['saveSuccess', 'saveError']);

const inputClasses = 'bg-gray-50/50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5';

const value = ref(props.field.value);

const refreshFields = () => {
  router.reload({ only: ['material'] });
};

watch(
  [value],
  debounce(() => {
    updateField();
  }, 1000)
);

const updateField = () => {
  axios
    .post(
      route('api.admin.materials.fields.update', {
        material: props.field.material_id,
        field: props.field.id,
      }),
      {
        value: value.value,
      }
    )
    .then(() => {
      emit('saveSuccess');
      refreshFields();
    })
    .catch(() => {
      emit('saveError');
      refreshFields();
    });
};
</script>
<template>
  <div class="w-full px-2">
    <div>
      <ContentAccess :permissions="[permissions.UPDATE]">
        <input
          id="value"
          v-model="value"
          type="text"
          :class="inputClasses"
          placeholder="Wartość"
          required
        >
      </ContentAccess>
    </div>
  </div>
</template>
