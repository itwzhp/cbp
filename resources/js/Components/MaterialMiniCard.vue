<script setup>
import { useSearchStore } from "../store/search.store";

const props = defineProps({
  type: { type: String, required: true },
  title: { type: String, required: true },
  author: { type: String, required: true },
  published: { type: String, required: true }
})

</script>
<template>
  <div class="flex justify-center p-3">
    <div class="flex flex-col md:flex-row md:max-w-xl rounded-lg bg-white shadow-lg">
      <div class="p-2 w-24 h-24 flex flex-col justify-start bg-neutral-500 rounded-sm">
        <p class="text-xs w-3/4 text-center bg-gray-200 rounded">
          {{props.type}}
        </p>
      </div>
      <div class="p-1 pl-3 pr-3 flex flex-col justify-start">
        <div class="h-2/6">
          <h5 class="text-blue-500 text-sm font-medium mb-2">
            {{props.title}}
          </h5>
        </div>
        <div class="h-3/6">
          <p class="text-gray-500 text-sm mb-2">
            Autor: {{props.author}}
          </p>
        </div>
        <div class="h-1/6">
          <div>
            <p class="text-gray-600 text-xs">
              Opublikowano: {{props.published}}
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
