<script setup>
const singleItemSections = [
  // 'Licencja',
  'Wymagania organizacyjne',
];
const multiItemSections = ['Załączniki', 'Scenariusz'];
const alternativeMultiItemSections = [
  'Cele i zamierzenia',
  'Zakres tematyczny',
  'Realizowane wymagania z instrumentów metodycznych',
];
</script>

<template>
  <div
    class="w-full mt-4 sm:mt-0 max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6"
  >
    <h5 class="mb-3 text-base font-semibold text-gray-900 md:text-xl">
      Dostępne sekcje:
    </h5>
    <ul class="my-4 space-y-3">
      <li
        v-for="(singleItemSection, key) in singleItemSections"
        :key="key"
      >
        <a
          class="flex cursor-pointer py-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow"
        >
          <span
            class="inline-flex max-h-6 items-center justify-center px-2 py-0.5 ml-3 text-sm font-bold text-gray-500 bg-gray-200 rounded"
          >+</span>
          <span class="flex-1 ml-3">{{ singleItemSection }}</span>
        </a>
      </li>
      <hr>
      <li
        v-for="(multiItemSection, key) in multiItemSections"
        :key="key"
      >
        <a
          class="flex cursor-pointer py-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow"
        >
          <span
            class="inline-flex max-h-6 items-center justify-center px-2 py-0.5 ml-3 text-sm font-bold text-gray-500 bg-gray-200 rounded"
          >+</span>
          <span class="flex-1 ml-3">{{ multiItemSection }}</span>
        </a>
      </li>
      <hr>
      <li
        v-for="(alternativeMultiItemSection, key) in alternativeMultiItemSections"
        :key="key"
      >
        <a
          class="flex cursor-pointer py-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow"
        >
          <span
            class="inline-flex max-h-6 items-center justify-center px-2 py-0.5 ml-3 text-sm font-bold text-gray-500 bg-gray-200 rounded"
          >+</span>
          <span class="flex-1 ml-3">{{ alternativeMultiItemSection }}</span>
        </a>
      </li>
    </ul>
  </div>
</template>
