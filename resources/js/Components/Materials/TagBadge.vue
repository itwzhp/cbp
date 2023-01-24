<script setup>
  import { router } from '@inertiajs/vue3'
  import { useSearchStore } from "@/store/search.store";
  const props = defineProps({
    tag: { type: Object, required: true }
  });
  const store = useSearchStore();
  const isMaterialsIndexRoute = route().current() ===  'materials.index';
  const redirect = () => {
    if (!isMaterialsIndexRoute) {
      router.get(route('materials.index'));
    }
  };
  const tagRemove = (tag) => store.removeTags([tag], !isMaterialsIndexRoute).then(() => redirect());
</script>

<template>
  <button
    @click="tagRemove(tag.id)"
    type="button"
    class="border border-1 border-zhp-300 hover:border-zhp-500 px-2 py-1 m-0.5 text-xs font-medium text-center rounded-3xl focus:ring-1 focus:outline-none focus:zhp-500 text-white bg-zhp-500"
  >
    {{ tag.name }}
    <font-awesome-icon  class="text-xs cursor-pointer" icon="fa-solid fa-xmark" />
  </button>
</template>
