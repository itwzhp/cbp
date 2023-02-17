<script setup>

defineProps({
    intents: {
        type: Array,
        required: true
    }
});
</script>

<template>
  <div v-if="intents.length">
    <h3 class="mt-3 mb-1 text-xl border-b-2 border-gray-200">
      Po zajęciach uczestniczka/uczestnik będzie:
    </h3>
    <ul class="list-disc list-inside">
      <li
        v-for="(intent, id) in intents"
        :key="id"
        class=""
      >
        {{ intent.value }}
      </li>
    </ul>
  </div>
</template>
