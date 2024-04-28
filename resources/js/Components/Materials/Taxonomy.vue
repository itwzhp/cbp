<script setup>
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { ref } from 'vue';

const props = defineProps({
  item: { type: Object, required: true },
  defaultIds: { type: Array, required: true },
  allowHide: { type: Boolean, required: false },
});

const emit = defineEmits(['tagSelected', 'tagRemoved']);
const isTagSelected = (tagId) => props.defaultIds.includes(tagId);
const tagAction = (tagId) => {
  if (isTagSelected(tagId)) {
    emit('tagRemoved', tagId);
  } else {
    emit('tagSelected', tagId);
  }
};

const collapsed = ref(false);
const changeCollapse = () => {
  if (props.allowHide) {
    collapsed.value = !collapsed.value;
  }
};

const countChoosenTags = () => {
  const tagIds = props.item.tags.map((tag) => tag.id);
  return tagIds?.length && props.defaultIds.filter((x) => tagIds.includes(x)).length;
};
</script>

<template>
  <div class="mb-3">
    <p
      class="mb-1 font-medium"
      :class="{ 'cursor-pointer': props.allowHide }"
      @click="changeCollapse()"
    >
      {{ item.taxonomy_name }}
      <button
        v-if="allowHide"
        class="text-sm px-1"
      >
        {{ collapsed && props.defaultIds?.length ? countChoosenTags() : "" }}
        <FontAwesomeIcon
          v-if="collapsed"
          icon="chevron-down"
        />
        <FontAwesomeIcon
          v-if="!collapsed"
          icon="chevron-up"
        />
      </button>
    </p>
    <div v-if="!collapsed">
      <template
        v-for="(tag, index) in props.item.tags"
        :key="index"
      >
        <button
          type="button"
          class="border border-1 border-cbp-300 hover:border-cbp-500 px-2 py-1 m-0.5 text-xs font-medium text-center rounded focus:ring-1 focus:outline-none focus:cbp-500"
          :class="{
            'text-white': isTagSelected(tag.id),
            'bg-cbp-100': isTagSelected(tag.id),
          }"
          @click="tagAction(tag.id)"
        >
          {{ tag.name }}
          <font-awesome-icon
            v-if="isTagSelected(tag.id)"
            class="text-xs cursor-pointer"
            icon="fa-solid fa-xmark"
          />
        </button>
      </template>
    </div>
  </div>
</template>
