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
const proofreaders = computed(() => findFields('proofreader'));
const typesetters = computed(() => findFields('typesetter'));
const translators = computed(() => findFields('translator'));
</script>

<template>
  <div v-if="authors.length || reviewers.length || redactors.length || proofreaders.length || typesetters.length || translators.length">
    <h3 class="text-lg font-bold mb-2 mt-4">
      Stopka redakcyjna
    </h3>
    <template v-if="authors.length">
      <h5 class="text-md font-bold mb-2">
        Autorzy
      </h5>
      <div
        v-for="(author, key) in authors"
        :key="key"
        class="gap-1 mt-5 mb-5"
      >
        <div class="w-full">
          <h3 class="text-md leading-4">
            {{ author.value }}
          </h3>
        </div>
      </div>
    </template>
    <template v-if="redactors.length">
      <h5 class="text-md font-bold mb-2">
        Redaktorzy
      </h5>
      <div
        v-for="(redactor, key) in redactors"
        :key="key"
        class="gap-1 mt-5 mb-5"
      >
        <div class="w-full">
          <h3 class="text-md leading-4">
            {{ redactor.value }}
          </h3>
        </div>
      </div>
    </template>
    <template v-if="reviewers.length">
      <h5 class="text-md font-bold mb-2">
        Recenzenci
      </h5>
      <div
        v-for="(reviewer, key) in reviewers"
        :key="key"
        class="gap-1 mt-5 mb-5"
      >
        <div class="w-full">
          <h3 class="text-md leading-4">
            {{ reviewer.value }}
          </h3>
        </div>
      </div>
    </template>
    <template v-if="proofreaders.length">
      <h5 class="text-md font-bold mb-2">
        Korekta
      </h5>
      <div
        v-for="(proofreader, key) in proofreaders"
        :key="key"
        class="gap-1 mt-5 mb-5"
      >
        <div class="w-full">
          <h3 class="text-md leading-4">
            {{ proofreader.value }}
          </h3>
        </div>
      </div>
    </template>
    <template v-if="typesetters.length">
      <h5 class="text-md font-bold mb-2">
        Skład
      </h5>
      <div
        v-for="(typesetter, key) in typesetters"
        :key="key"
        class="gap-1 mt-5 mb-5"
      >
        <div class="w-full">
          <h3 class="text-md leading-4">
            {{ typesetter.value }}
          </h3>
        </div>
      </div>
    </template>
    <template v-if="translators.length">
      <h5 class="text-md font-bold mb-2">
        Tłumaczenie
      </h5>
      <div
        v-for="(translator, key) in translators"
        :key="key"
        class="gap-1 mt-5 mb-5"
      >
        <div class="w-full">
          <h3 class="text-md leading-4">
            {{ translator.value }}
          </h3>
        </div>
      </div>
    </template>
  </div>
</template>
