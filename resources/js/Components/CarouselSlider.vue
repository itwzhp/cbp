<script setup>
import { ref } from 'vue'
import { Carousel, Pagination, Slide, Navigation } from 'vue3-carousel'
import Spinner from "@/Components/Spinner.vue";
import 'vue3-carousel/dist/carousel.css'
</script>
<template>
  <div v-if="!$page.props.slider" class="h-96 flex justify-center items-center">
    <Spinner />
  </div>
  <Carousel v-else :autoplay="5000" :pauseAutoplayOnHover="true" :items-to-show="1" :wrap-around="true" >
    <Slide v-for="slide in $page.props.slider" :key="slide.id">
      <div class="carousel__item h-full w-full flex justify-center items-center">
        <a :href="slide.url">
          <figure class="relative max-w transition-all duration-300 cursor-pointer">
            <img :src="slide.image" :alt="slide.image">
            <figcaption v-if="slide.image" class="absolute px-3 text-lg text-white bottom-8 left-4">
              <span class="bg-cbp-300 text-white text-2xl font-medium px-2 py-2 rounded">
                {{ 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vitae dolor mi.' }}
              </span>
            </figcaption>
          </figure>
        </a>
      </div>
    </Slide>

    <template #addons>
      <Navigation />
    </template>
  </Carousel>
</template>
