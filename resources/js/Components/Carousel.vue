<script setup>
import { Carousel, Slide, Navigation } from 'vue3-carousel';
import SliderCard from '@/Components/SliderCard.vue';
import Spinner from '@/Components/Spinner.vue';

const breakpoints = {
  640: {
    itemsToShow: 2,
    snapAlign: 'center',
  },
  950: {
    itemsToShow: 3,
    snapAlign: 'center',
  },
  1280: {
    itemsToShow: 4,
    snapAlign: 'start',
  },
};
</script>

<template>
  <div
    v-if="!$page.props.suggestions"
    class="text-center pt-2"
  >
    <Spinner />
  </div>
  <Carousel
    v-else
    :items-to-show="1"
    :snap-align="'center'"
    :wrap-around="true"
    :breakpoints="breakpoints"
  >
    <Slide
      v-for="slide in $page.props.suggestions"
      :key="slide.id"
    >
      <div class="slide-item w-4/6 sm:w-[288px]">
        <SliderCard :slide="slide" />
      </div>
    </Slide>

    <template #addons>
      <navigation>
        <template #next>
          <div
            class="shadow-xl flex justify-center items-center h-8 w-8 text-cbp-100 bg-white border-solid border-cbp-100 rounded-full"
          >
            <font-awesome-icon
              icon="fa-solid fa-chevron-right"
              class="block h-4 w-4"
            />
          </div>
        </template>
        <template #prev>
          <div
            class="shadow-xl flex justify-center items-center h-8 w-8 text-cbp-100 bg-white border-solid border-cbp-100 rounded-full"
          >
            <font-awesome-icon
              icon="fa-solid fa-chevron-left"
              class="block h-4 w-4"
            />
          </div>
        </template>
      </navigation>
    </template>
  </Carousel>
</template>

<style>
.slide-item {
  height: 400px;
  background-color: white;
  margin: 0 0.5rem;
}
</style>
