<script setup>
import { useSearchStore } from "@/store/search.store";
const store = useSearchStore();
const clearInput = () => store.clearInput();
</script>

<template>
  <button @click="clearInput()" type="button"
    class="border border-1 border-cbp-100 hover:border-cbp-400 px-2 py-1 m-0.5 text-xs font-medium text-center rounded-3xl focus:ring-1 focus:outline-none focus:cbp-400 text-white bg-cbp-100">
    "{{ store.getSearchInput }}"
    <font-awesome-icon class="text-xs cursor-pointer" icon="fa-solid fa-xmark" />
  </button>
</template>
