<script setup>
import { ref, watch, onUnmounted, onMounted } from 'vue'
import { watchEffect } from '@vue/runtime-core';
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { useForm } from '@inertiajs/inertia-vue3';
import { useSearchStore } from "../store/search.store";
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import MaterialMiniCard from '@/Components/MaterialMiniCard.vue';
import Spinner from '@/Components/Spinner.vue';

const store = useSearchStore();
let scrollContent;

const addListener = () => {
  scrollContent = document.getElementById('infinite-scroll');
  scrollContent.addEventListener('scroll', handleScroll);
}

const removeListener = () => {
  if (scrollContent) {
    scrollContent.removeEventListener('scroll', handleScroll);
    scrollContent = null;
  }
}

const handleScroll = () => {
  const scrolled = scrollContent.scrollTop; // reuse `scrollContent` innstead of querying the DOM again
  if (scrollContent.scrollTop + scrollContent.clientHeight == scrollContent.scrollHeight) {
    store.getData(form.search, true);
  }
  console.log(scrollContent.scrollTop + scrollContent.clientHeight == scrollContent.scrollHeight);
}

onMounted(() => {
  watchEffect(() => {
    const data = store.getShowDialog;
    setTimeout(() => {
      if (data) {
        addListener();
      } else {
        removeListener();
      }
    });
  })

})

const form = useForm({
  search: store.getSearchInput,
});

const submit = () => {
  if (scrollContent) {
    scrollContent.scrollTop = 0;
  }
  store.getData(form.search)
};

const hideDialog = () => {
  store.hideDialog();
}

</script>
<template>
    <TransitionRoot as="template" :show="store.getShowDialog">
      <Dialog as="div" class="relative z-10" @close="hideDialog()">
        <TransitionChild as="template" enter="ease-in-out duration-500" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in-out duration-500" leave-from="opacity-100" leave-to="opacity-0">
          <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
        </TransitionChild>
  
        <div class="fixed inset-0 overflow-hidden">
          <div class="absolute inset-0 overflow-hidden">
            <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full">
              <TransitionChild as="template" enter="transform transition ease-in-out duration-500 sm:duration-700" enter-from="translate-x-full" enter-to="translate-x-0" leave="transform transition ease-in-out duration-500 sm:duration-700" leave-from="translate-x-0" leave-to="translate-x-full">
                <DialogPanel class="pointer-events-auto relative w-screen max-w-full">
                  <div class="flex h-3/4 flex-col bg-white py-6 shadow-xl">
                    <!-- <div class="px-4 sm:px-6">
                      <DialogTitle class="text-lg font-medium text-gray-900">Wpisz wyszukiwaną frazę</DialogTitle>
                    </div> -->
                    <div class="relative mt-6 flex-1 px-4 sm:px-6">
                      <form @submit.prevent="submit" class="pb-3">
                        <div>
                            <TextInput id="search" type="search" class="mt-1 block w-full text-xl" :disabled="store.getLoading" v-model="form.search" autocomplete="current-search" autofocus placeholder="Wpisz wyszukiwaną frazę" />
                            <InputError class="mt-2" :message="form.errors.search" />
                        </div>
                        <div class="flex justify-end">
                          Wciśnij Enter żeby zatwierdzić, wciśnij ESC żeby wyjść
                        </div>
                      </form>
                      <div id="infinite-scroll" style="overflow:auto; max-height: 600px;" class="infinite-scroll grid xs:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                        <MaterialMiniCard
                          v-for="(item, index) in store.getSearchData" :key="index"
                          :item="item"
                        />
                      </div>
                      <div v-if="store.getLoading" class="text-center">
                        <Spinner />
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
