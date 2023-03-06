<script setup>
import { router } from '@inertiajs/vue3';
import { useSearchStore } from '@/store/search.store';
const props = defineProps({
  tag: { type: Object, required: true },
});
const store = useSearchStore();
const isMaterialsIndexRoute = route().current() === 'materials.index';
const redirect = () => {
  if (!isMaterialsIndexRoute) {
    router.get(route('materials.index'));
  }
};
const tagRemove = (tag) =>
  store.removeTags([tag], !isMaterialsIndexRoute).then(() => redirect());
</script>

<template>
  <button
    type="button"
    class="border border-1 border-cbp-300 hover:border-cbp-300 px-2 py-1 m-0.5 text-xs font-medium text-center rounded focus:ring-1 focus:outline-none focus:cbp-300 text-white bg-cbp-100"
    @click="tagRemove(tag.id)"
  >
    {{ tag.name }}
    <font-awesome-icon
      class="text-xs cursor-pointer"
      icon="fa-solid fa-xmark"
    />
  </button>
</template>
