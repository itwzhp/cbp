<script setup>
import { computed } from 'vue';

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
  <div>
    <template v-if="authors.length">
      <h3 class="font-bold">
        Autorzy:
      </h3>
      <div
        v-for="(author, key) in authors"
        :key="key"
      >
        <h5 class="text-sm">
          {{ author.value }}
        </h5>
      </div>
    </template>

    <template v-if="redactors.length">
      <h3 class="font-bold mt-3">
        Redaktorzy:
      </h3>
      <div
        v-for="(redactor, key) in redactors"
        :key="key"
      >
        <h5 class="text-sm">
          {{ redactor.value }}
        </h5>
      </div>
    </template>

    <template v-if="reviewers.length">
      <h3 class="font-bold mt-3">
        Recenzenci:
      </h3>
      <div
        v-for="(reviewer, key) in reviewers"
        :key="key"
      >
        <h5 class="text-sm">
          {{ reviewer.value }}
        </h5>
      </div>
    </template>
  </div>
</template>
