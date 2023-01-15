<script setup>
  const props = defineProps({
    item: { type: Object, required: true },
    defaultIds: { type: Array, required: true }
  });
  const emit = defineEmits(['tagSelected', 'tagRemoved']);
  const isTagSelected = (tagId) => props.defaultIds.includes(tagId);
  const tagAction = (tagId) => {
    if (isTagSelected(tagId)) {
      emit('tagRemoved', tagId);
    } else {
      emit('tagSelected', tagId);
    }
  }
</script>

<template>
  <div class="mb-3">
    <p class="mb-1 font-bold">
      {{ item.taxonomy_name }}
    </p>
    <template v-for="(tag, index) in props.item.tags" :key="index">
      <button
        @click="tagAction(tag.id)"
        type="button"
        class="border border-1 border-zhp-300 hover:border-zhp-500 px-2 py-1 m-0.5 text-xs font-medium text-center rounded-3xl focus:ring-1 focus:outline-none focus:zhp-500"
        :class="{ 'text-white': isTagSelected(tag.id), 'bg-zhp-500': isTagSelected(tag.id) }"
      >
        {{ tag.name }}
        <font-awesome-icon v-if="isTagSelected(tag.id)" class="text-xs cursor-pointer" icon="fa-solid fa-xmark" />
      </button>
    </template>
  </div>
</template>
