<script setup>
import { onUnmounted, onMounted } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { useSearchStore } from '@/store/search.store';
import MaterialCard from '@/Components/MaterialCard.vue';
import TagBadge from '@/Components/Materials/TagBadge.vue';
import SearchInputBadge from '@/Components/Materials/SearchInputBadge.vue';
import { watchEffect } from 'vue';
import Spinner from '@/Components/Spinner.vue';
import { usePage } from '@inertiajs/vue3';

const tags = usePage().props.tags;
const store = useSearchStore();

if (route().current() === 'materials.index') {
  store.getData();
} else {
  store.getData(null, tags ? tags : []);
}

let scrollContent;

const addListener = () => {
  scrollContent = document.getElementsByTagName('body')[0];
  scrollContent.onscroll = () => handleScroll();
};


const handleScroll = () => {
  if (Math.round(window.scrollY + window.innerHeight) >= Math.round(document.body.scrollHeight)) {
    console.log('[scroll event] load next page...');
    store.getNextPage();
  }
};

const displayDialog = () => store.displayDialog();

onMounted(() => {
  addListener();
  watchEffect(() => {
    const props = store.getRefreshedAt;
    if (scrollContent) {
      scrollContent.scrollTop = 0;
    }
  });

  if(usePage().props.search){
    store.getData(usePage().props.search,[]);
  }
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
          <div class="p-6 md:py-3 md:px-0 border-b border-gray-200">
            <div class="pb-2">
              <button
                type="button"
                class="font-bold border border-2 border-cbp-100 hover:border-cbp-300 px-3 py-2 text-xs font-medium text-center rounded focus:ring-1 focus:outline-none focus:cbp-300"
                @click="displayDialog()"
              >
                <font-awesome-icon icon="fa-solid fa-sliders" />
                Wszystkie filtry
              </button>
            </div>
            <div v-if="store.getSearchInput?.length || store.getTagIds?.length">
              <div
                v-if="store.getSearchInput?.length"
                class="pb-2"
              >
                <div>Szukana fraza</div>
                <SearchInputBadge />
              </div>
              <div v-if="store.getTagIds?.length">
                <div>Tagi</div>
                <template
                  v-for="(item, index) in store.getTagDetails"
                  :key="index"
                >
                  <TagBadge :tag="item" />
                </template>
              </div>
              <hr class="mt-5 mb-5">
            </div>
            <div
              v-if="store.getSearchData?.length === 0 && store.getLoading"
              class="text-center pt-2"
            >
              <Spinner />
            </div>
            <div
              v-if="store.getSearchData?.length === 0 && !store.getLoading"
              class="text-center pt-2"
            >
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
