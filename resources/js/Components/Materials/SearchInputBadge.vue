<script setup>
  import { useSearchStore } from "@/store/search.store";
  const store = useSearchStore();
  const clearInput = () => store.clearInput();
</script>

<template>
    <span class="bg-zhp-100 text-dark-800 text-md font-medium mr-2 px-2.5 py-0.5 rounded">
    {{ store.getSearchInput }}
    <font-awesome-icon @click="clearInput()" class="text-sm cursor-pointer" icon="fa-solid fa-xmark" />
  </span>
</template>
