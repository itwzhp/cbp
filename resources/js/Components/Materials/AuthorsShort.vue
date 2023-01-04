<script setup>
  import { computed } from "vue";

  const props = defineProps({
    fields: {
        type: Array,
        required: true
    }
  });
  const filterFields = (type) => {
    let group = props.fields.filter((item) => item.type === type);
    return group.length ? group[0].fields : [];
  };
  const authors = computed(() => filterFields('author'));
  const reviewers = computed(() => filterFields('reviewer'));
  const redactors = computed(() => filterFields('redactor'));
</script>

<template>
  <div>
    <h3 class="font-bold">Autorzy:</h3>
    <div v-for="(author, key) in authors" :key="key">
      <h5 class="text-sm">{{ author.value }}</h5>
    </div>

    <h3 class="font-bold mt-3">Redaktorzy:</h3>
    <div v-for="(redactor, key) in redactors" :key="key">
      <h5 class="text-sm">{{ redactor.value }}</h5>
    </div>

    <h3 class="font-bold mt-3">Recenzenci:</h3>
    <div v-for="(reviewer, key) in reviewers" :key="key">
      <h5 class="text-sm">{{ reviewer.value }}</h5>
    </div>
  </div>
</template>
