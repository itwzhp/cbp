<script setup>
import { watch } from 'vue';
import { useForm } from '@inertiajs/vue3';
import { useSearchStore } from '../../store/search.store';

const emit = defineEmits(['searchSubmit']);
const store = useSearchStore();
const form = useForm({ search: store.getSearchInput });

watch(store, () => {
  if (!store.getSearchInput) {
    form.search = null;
  }
});

const submit = () => emit('searchSubmit', form.search);
</script>

<template>
  <form
    class="pb-3"
    @submit.prevent="submit"
  >
    <label
      for="default-search"
      class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white"
    >Search</label>
    <div class="relative">
      <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
        <svg
          aria-hidden="true"
          class="w-5 h-5 text-gray-500 dark:text-gray-400"
          fill="none"
          stroke="currentColor"
          viewBox="0 0 24 24"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
          />
        </svg>
      </div>
      <input
        id="default-search"
        v-model="form.search"
        minlength="3"
        type="search"
        :disabled="store.getLoading"
        class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-cbp-300 focus:border-cbp-300"
        placeholder="Wpisz wyszukiwaną frazę"
      >
      <button
        type="submit"
        class="text-white absolute right-2.5 bottom-2.5 bg-cbp-100 hover:bg-cbp-200 focus:ring-2 focus:outline-none focus:ring-cbp-100 font-medium rounded-lg text-sm px-4 py-2"
      >
        Szukaj
      </button>
    </div>
  </form>
</template>
