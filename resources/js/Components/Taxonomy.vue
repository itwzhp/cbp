<script setup>
  import { ref } from 'vue';
  import Multiselect from '@vueform/multiselect'

  const props = defineProps({
    item: { type: Object, required: true },
    defaultIds: { type: Array, required: true }
  });
  const emit = defineEmits(['tagSelected', 'tagRemoved']);

  const ids = props.defaultIds.map(id => id) || [];
  const defaultValues = () => props.item.tags.filter(tag => props.defaultIds.map(id => id).includes(tag.id));  
  const value = ref(ids.length ? defaultValues() : []);

  const mapTags = (tags) => {
    return tags.map(tag => {
      return {value: tag.id, name: tag.name};
    });
  }
  const select = ($event) => emit('tagSelected', $event.value);
  const deselect = ($event) => emit('tagRemoved', $event.value);
</script>

<template>
  <Multiselect
      v-model="value"
      :options="mapTags(item.tags)"
      :searchable="true"
      mode="tags"
      label="name"
      trackBy="name"
      :object="true"
      :placeholder="item.taxonomy_name"
      :close-on-select="false"
      @select="select($event)"
      @deselect="deselect($event)">
    <template v-slot:tag="{ option, handleTagRemove, disabled }">
      <div class="multiselect-tag is-user" :class="{'is-disabled': disabled}">
        <img :src="option.image">
        {{ option.name }}
        <span v-if="!disabled" class="multiselect-tag-remove" @click="handleTagRemove(option, $event)">
          <span class="multiselect-tag-remove-icon"></span>
        </span>
      </div>
    </template>
  </Multiselect>
</template>
