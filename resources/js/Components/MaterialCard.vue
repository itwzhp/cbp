<script setup>

const props = defineProps({
  item: { type: Object, required: true }
})

const truncateText = (text, length, suffix) => {
  if (text.length > length) {
      return text.substring(0, length) + suffix;
  } else {
      return text;
  }
};

</script>
<template>
    <div class="w-full mb-3 text-center bg-white border rounded-lg shadow-md sm:p-1 dark:bg-gray-800 dark:border-gray-700">
      <h5 class="mb-5 mt-5 text-3xl font-bold text-gray-900 dark:text-white"> {{ props.item.title }}</h5>
      <p class="mb-5 text-base text-gray-500 sm:text-lg dark:text-gray-400">{{ props.item.owner.name }}</p>
      <p class="mb-5 text-base text-gray-500 sm:text-lg dark:text-gray-400">Opublikowano: {{ $filters.dateFormat(props.item.published_at) }}</p>
    </div>
</template>
