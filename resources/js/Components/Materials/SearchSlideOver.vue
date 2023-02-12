<script setup>
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { router } from '@inertiajs/vue3'
import { useSearchStore } from "../../store/search.store";
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import Taxonomy from '@/Components/Materials/Taxonomy.vue';
import TagSearchMode from '@/Components/Materials/TagSearchMode.vue';
import SearchForm from '@/Components/Materials/SearchForm.vue';

const store = useSearchStore();
store.getTaxonomies();
const redirect = () => {
  if (route().current() !== 'materials.index') {
    router.visit(route('materials.index'));
  }
};

const tagSelected = (tag) => store.pushTags([tag]).then(() => redirect());
const tagRemoved = (tag) => store.removeTags([tag]).then(() => redirect());
const tagModeChanged = (mode) => store.setTagMode(mode).then(() => redirect());
const searchSubmit = (search) => store.getData(search, store.getTagIds).then(() => redirect());
const hideDialog = () => store.hideDialog();
</script>
<template>
  <TransitionRoot as="template" :show="store.getShowDialog">
    <Dialog as="div" class="relative z-10" @close="hideDialog()">
      <TransitionChild as="template" enter="ease-in-out duration-500" enter-from="opacity-0" enter-to="opacity-100"
        leave="ease-in-out duration-500" leave-from="opacity-100" leave-to="opacity-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
      </TransitionChild>
      <div class="fixed inset-0">
        <div class="absolute inset-0">
          <div class="pointer-events-none fixed inset-y-0 flex max-w-full">
            <TransitionChild as="template" enter="transform transition ease-in-out duration-500 sm:duration-700"
              enter-from="-translate-x-full" enter-to="-translate-x-0"
              leave="transform transition ease-in-out duration-500 sm:duration-700" leave-from="-translate-x-0"
              leave-to="-translate-x-full">
              <DialogPanel class="pointer-events-auto relative w-screen max-w-md overflow-auto bg-white">
                <div class="flex h-full flex-col bg-white py-6">
                  <div class="px-4 sm:px-6">
                    <DialogTitle class="text-lg font-medium text-gray-900 text-left">
                      <button @click="hideDialog()" type="button"
                        class="text-cbp-100 border border-cbp-300 hover:bg-cbp-300 hover:text-white focus:ring-4 focus:outline-none focus:ring-neutral-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:focus:ring-blue-800">
                        <svg style="transform: rotate(180deg)" aria-hidden="true" class="w-5 h-5" fill="currentColor"
                          viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                          <path fill-rule="evenodd"
                            d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Icon description</span>
                      </button>
                    </DialogTitle>
                  </div>
                  <div class="relative mt-6 flex-1 px-4 sm:px-6">
                    <h3 class="mb-5 font-semibold text-gray-900 text-3xl">Filtry</h3>
                    <div>
                      <h3 class="mb-2 font-semibold text-gray-900 text-xl">Fraza</h3>
                      <SearchForm @searchSubmit="searchSubmit($event)" />
                    </div>
                    <hr hidden class="mt-5 mb-5">
                    <div hidden>
                      <h3 class="mb-2 font-semibold text-gray-900 text-xl">Tryb tagów</h3>
                      <TagSearchMode @modeChanged="tagModeChanged($event)" :mode="store.getTagMode" />
                    </div>
                    <hr class="mt-5 mb-5">
                    <div>
                      <h3 class="mb-4 font-semibold text-gray-900 text-xl">Tagi</h3>
                      <template v-for="(item, index) in store.getTaxonomiesData" :key="index">
                        <Taxonomy @tagSelected="tagSelected($event)" @tagRemoved="tagRemoved($event)" :item="item"
                          :defaultIds="store.getTagIds" />
                      </template>
                    </div>
                  </div>
                </div>
              </DialogPanel>
            </TransitionChild>
          </div>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
</template>
