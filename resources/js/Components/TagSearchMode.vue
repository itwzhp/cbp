<script setup>
  import { ref } from 'vue';
  import { watchEffect } from "@vue/runtime-core";
  import Multiselect from '@vueform/multiselect'

  const props = defineProps({
    mode: { type: String, required: true }
  });
  const emit = defineEmits(['modeChanged']);
  const mode = ref(props.mode);
  watchEffect(() => {
    emit('modeChanged', mode.value);
  })
</script>

<template>
  <ul class="items-center w-1/2 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
      <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
          <div class="flex items-center pl-3">
              <input v-model="mode" id="horizontal-list-radio-license" type="radio" value="or" name="list-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
              <label for="horizontal-list-radio-license" class="py-3 ml-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300">OR</label>
          </div>
      </li>
      <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
          <div class="flex items-center pl-3">
              <input v-model="mode" id="horizontal-list-radio-id" type="radio" value="and" name="list-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
              <label for="horizontal-list-radio-id" class="py-3 ml-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300">AND</label>
          </div>
      </li>
      <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
          <div class="flex items-center pl-3">
              <input v-model="mode" id="horizontal-list-radio-millitary" type="radio" value="andor" name="list-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
              <label for="horizontal-list-radio-millitary" class="py-3 ml-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300">ANDOR</label>
          </div>
      </li>
  </ul>
</template>
