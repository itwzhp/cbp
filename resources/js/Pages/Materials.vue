<script setup>
import { onUnmounted, onMounted } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/inertia-vue3";
import { useSearchStore } from "../store/search.store";
import MaterialCard from "@/Components/MaterialCard.vue";
import { watchEffect } from "@vue/runtime-core";
import Spinner from "@/Components/Spinner.vue";

const store = useSearchStore();
if (!store.getSearchData.length) {
  store.getData();
}

let scrollContent;

const addListener = () => {
  scrollContent = document.getElementById("main-content");
  scrollContent.addEventListener("scroll", handleScroll);
};

const handleScroll = () => {
  if (scrollContent.scrollTop + scrollContent.clientHeight == scrollContent.scrollHeight) {
    console.log("[scroll event] load next page...");
    store.getNextPage();
  }
};

onMounted(() => {
  addListener();
  watchEffect(() => {
    const data = store.getRefreshedAt;
    if (scrollContent) {
      scrollContent.scrollTop = 0;
    }
  });
});

onUnmounted(() => {
  watchEffect(() => {});
});
</script>

<template>
  <Head title="Materiały" />
  <AuthenticatedLayout>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 border-b border-gray-200">
            <div>
              <MaterialCard
                v-for="(item, index) in store.getSearchData"
                :key="index"
                :item="item"
              />
            </div>
            <!-- <div v-if="store.getLoading" class="text-center pt-2">
              <Spinner />
            </div> -->
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
