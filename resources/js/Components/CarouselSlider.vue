<script setup>
import { Carousel, Slide, Navigation } from 'vue3-carousel';
import Spinner from '@/Components/Spinner.vue';
import 'vue3-carousel/dist/carousel.css';
</script>
<template>
  <div
    v-if="!$page.props.slider"
    class="h-96 flex justify-center items-center"
  >
    <Spinner />
  </div>
  <Carousel
    v-else
    :autoplay="5000"
    :pause-autoplay-on-hover="true"
    :items-to-show="1"
    :wrap-around="true"
  >
    <Slide
      v-for="slide in $page.props.slider"
      :key="slide.id"
    >
      <div class="carousel__item h-full w-full flex justify-center items-center pt-8">
        <a :href="slide.url">
          <figure class="relative max-w transition-all duration-300 cursor-pointer">
            <img
              :src="slide.image"
              :alt="slide.image"
            >
          </figure>
        </a>
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
