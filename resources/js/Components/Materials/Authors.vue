<script setup>
import { computed } from 'vue';
import Avatar from '@/Components/Avatar.vue';

const props = defineProps({
  fields: {
    type: Array,
    required: true,
  },
});
const findFields = (type) => {
  const group = props.fields.find((item) => item.type === type);
  return group?.fields || [];
};
const authors = computed(() => findFields('author'));
const redactors = computed(() => findFields('redactor'));
const reviewers = computed(() => findFields('reviewer'));
</script>

<template>
  <div v-if="authors.length || reviewers.length || redactors.length">
    <h3 class="text-lg font-bold mb-2 mt-4">Stopka redakcyjna</h3>
    <template v-if="authors.length">
      <h5 class="text-md font-bold mb-2">Autorzy</h5>
      <div
        v-for="(author, key) in authors"
        :key="key"
        class="grid grid-cols-4 gap-1 place-items-center mt-5 mb-5"
      >
        <div class="col-span-1">
          <Avatar />
        </div>
        <div class="col-span-3 w-full">
          <h3 class="text-md leading-4">{{ author.value }}</h3>
        </div>
      </div>
    </template>
    <template v-if="redactors.length">
      <h5 class="text-md font-bold mb-2">Redaktorzy</h5>
      <div
        v-for="(redactor, key) in redactors"
        :key="key"
        class="grid grid-cols-4 gap-1 place-items-center mt-5 mb-5"
      >
        <div class="col-span-1">
          <Avatar />
        </div>
        <div class="col-span-3 w-full">
          <h3 class="text-md leading-4">{{ redactor.value }}</h3>
        </div>
      </div>
    </template>
    <template v-if="reviewers.length">
      <h5 class="text-md font-bold mb-2">Recenzenci</h5>
      <div
        v-for="(reviewer, key) in reviewers"
        :key="key"
        class="grid grid-cols-4 gap-1 place-items-center mt-5 mb-5"
      >
        <div class="col-span-1">
          <Avatar />
        </div>
        <div class="col-span-3 w-full">
          <h3 class="text-md leading-4">{{ reviewer.value }}</h3>
        </div>
      </div>
    </template>
  </div>
</template>
