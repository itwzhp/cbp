<script setup>
  import { Inertia } from "@inertiajs/inertia";
  import { useSearchStore } from "@/store/search.store";
  const props = defineProps({
    tag: { type: Object, required: true }
  });
  const store = useSearchStore();
  const isMaterialsIndexRoute = route().current() ===  'materials.index';
  const redirect = () => {
    if (!isMaterialsIndexRoute) {
      Inertia.get(route('materials.index'));
    }
  };
  const tagRemove = (tag) => store.removeTags([tag], !isMaterialsIndexRoute).then(() => redirect());
</script>

<template>
    <span class="bg-gray-100 text-gray-800 text-md font-medium mr-2 px-2.5 py-0.5 rounded">
    {{ tag.name }}
    <font-awesome-icon @click="tagRemove(tag.id)" class="text-sm cursor-pointer" icon="fa-solid fa-xmark" />
  </span>
</template>
