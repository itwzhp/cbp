<script setup>
import {onUnmounted, onMounted} from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head} from "@inertiajs/inertia-vue3";
import {useSearchStore} from "@/store/search.store";
import MaterialCard from "@/Components/MaterialCard.vue";
import TagBadge from "@/Components/Materials/TagBadge.vue";
import SearchInputBadge from "@/Components/Materials/SearchInputBadge.vue";
import {watchEffect} from "@vue/runtime-core";
import Spinner from "@/Components/Spinner.vue";
import {usePage} from '@inertiajs/inertia-vue3'

const tag = usePage().props.value.tag;
const store = useSearchStore();

// if (!store.getSearchData.length) {
//   store.getData();
// }
if (route().current() ===  'materials.index') {
  store.getData();
} else {
  store.getData(null, tag ? [tag] : []);
}

let scrollContent;

const addListener = () => {
  scrollContent = document.getElementById("main-content");
  scrollContent.addEventListener("scroll", handleScroll);
};

const handleScroll = () => {
    const eps = 2;

    if (scrollContent.scrollTop + scrollContent.clientHeight + eps > scrollContent.scrollHeight) {
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
    <div class="py-2">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 border-b border-gray-200">
            <div v-if="store.getSearchInput?.length || store.getTagIds?.length">
              <div v-if="store.getSearchInput?.length" class="pb-2">
                <div>Fraza:</div>
                <SearchInputBadge />
              </div>
              <div v-if="store.getTagIds?.length">
                <div>Kategorie:</div>
                <template v-for="(item, index) in store.getTagDetails" :key="index">
                  <TagBadge :tag="item" />
                </template>
              </div>
              <hr class="mt-5 mb-5">
            </div>
            <div v-if="store.getSearchData?.length === 0 && store.getLoading" class="text-center pt-2">
              <Spinner />
            </div>
            <div v-if="store.getSearchData?.length === 0 && !store.getLoading" class="text-center pt-2">
              Brak wyników
            </div>
            <div class="flex flex-wrap">
              <MaterialCard
                v-for="(item, index) in store.getSearchData"
                :key="index"
                :item="item"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
