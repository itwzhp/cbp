<script setup>

defineProps({
    fields: {
        type: Array,
        required: true
    }
});
</script>

<template>
  <div v-if="fields.length">
    <h3 class="mt-3 mb-1 text-xl border-b-2 border-gray-200">
      <slot />
    </h3>
    <ul class="list-disc list-inside">
      <li
        v-for="(intent, id) in fields"
        :key="id"
        class=""
      >
        {{ intent.value }}
      </li>
    </ul>
  </div>
</template>
