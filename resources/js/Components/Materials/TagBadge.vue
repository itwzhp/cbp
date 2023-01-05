<script setup>
  import { useSearchStore } from "@/store/search.store";
  const props = defineProps({
    tag: { type: Object, required: true }
  });
  const store = useSearchStore();
  const tagRemove = (tag) => store.removeTags([tag]);
</script>

<template>
    <span class="bg-gray-100 text-gray-800 text-md font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">
    {{ tag.name }}
    <font-awesome-icon @click="tagRemove(tag.id)" class="text-sm cursor-pointer" icon="fa-solid fa-xmark" />
  </span>
</template>
