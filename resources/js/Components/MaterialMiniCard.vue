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
    <div class="flex flex-col sm:flex-row sm:max-w-xl rounded-lg bg-white shadow-lg">
      <div class="p-2 md:w-100 w-36 h-auto flex flex-col justify-start bg-neutral-500 rounded-sm">
        <p class="text-xs w-100 text-center bg-gray-200 rounded">
          Poradnik
        </p>
      </div>
      <div class="p-1 pl-3 flex flex-col justify-start w-full">
        <div class="h-3/6">
          <h5 class="text-blue-500 text-sm font-medium mb-2">
            <span class="">{{ truncateText(props.item.title, 80, '...') }}</span>
          </h5>
        </div>
        <div class="h-2/6">
          <p class="text-gray-500 text-sm mb-2">
            Autor: <span class="">{{ props.item.owner.name }}</span>
          </p>
        </div>
        <div class="h-1/6">
          <div>
            <p class="text-gray-600 text-xs">
              Opublikowano: {{ $filters.dateFormat(props.item.published_at) }}
            </p>
          </div>
        </div>
      </div>
    </div>
</template>
