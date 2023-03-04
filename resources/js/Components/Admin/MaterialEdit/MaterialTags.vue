<script setup>
import { router, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';
import axios from 'axios';
import { useSearchStore } from '../../../store/search.store';
import Taxonomy from '@/Components/Materials/Taxonomy.vue';

const store = useSearchStore();
const materialId = usePage().props.material.id;

const requestResultInfoTime = 5000;
const savedChanges = ref(false);
const saveChangesError = ref(false);
let successTimeout = null;
let errorTimeout = null;

const successInfo = () => {
  saveChangesError.value = false;
  savedChanges.value = true;
  clearTimeout(successTimeout);
  successTimeout = setTimeout(() => {
    savedChanges.value = false;
  }, requestResultInfoTime);
};

const errorInfo = () => {
  savedChanges.value = false;
  saveChangesError.value = true;
  clearTimeout(errorTimeout);
  errorTimeout = setTimeout(() => {
    saveChangesError.value = false;
  }, requestResultInfoTime);
};

const refreshMaterial = () => {
  router.reload({ only: ['material'] });
};

const attachTag = (tagId) => {
  axios
    .post(
      route('api.admin.materials.tags.attach', {
        material: materialId,
        tag: tagId,
      })
    )
    .then(() => {
      successInfo();
      refreshMaterial();
    })
    .catch(() => {
      errorInfo();
    });
};

const detachTag = (tagId) => {
  axios
    .post(
      route('api.admin.materials.tags.detach', {
        material: materialId,
        tag: tagId,
      })
    )
    .then(() => {
      successInfo();
      refreshMaterial();
    })
    .catch(() => {
      errorInfo();
    });
};

const getMaterialTagIds = (materialTags) => {
  // TODO map to array of IDs
  return materialTags || [];
};
</script>

<template>
  <div class="flex justify-between text-sm pb-2">
    <div>Tagi</div>
    <div>
      <span
        v-if="savedChanges"
        class="text-green-600"
      >Zapisano wprowadzone zmiany</span>
      <span
        v-if="saveChangesError"
        class="text-red-600"
      >Wystąpił błąd! Zmiany nie zostały zapisane.</span>
    </div>
  </div>
  <div class="w-full bg-gray-50/50 bg-white border border-gray-200 rounded-lg p-3">
    <template
      v-for="(item, index) in store.getTaxonomiesData"
      :key="index"
    >
      <Taxonomy
        :item="item"
        :allow-hide="true"
        :default-ids="getMaterialTagIds($page.props.material.tags)"
        @tag-selected="attachTag($event)"
        @tag-removed="detachTag($event)"
      />
    </template>
  </div>
</template>
