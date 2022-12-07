<script setup>
import { ref } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/inertia-vue3";
import axios from "axios";

const material = ref(null);
const title = ref('');
const tag = route().params.tag;
if (tag) {
  axios.get(`${import.meta.env.VITE_API_URL}/api/materials/${tag}`).then(res => {
    material.value = res.data;
    title.value = res.data.title;
  });
}
</script>

<template>
  <Head :title="title" />
  <AuthenticatedLayout>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 border-b border-gray-200">
            {{ material }}
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
