<script setup>
import { ref } from 'vue'
import { Carousel, Pagination, Slide, Navigation } from 'vue3-carousel'
import Spinner from "@/Components/Spinner.vue";

import 'vue3-carousel/dist/carousel.css'
const loading = ref(true);
const sliders = ref([]);

axios.get(`${import.meta.env.VITE_API_URL}/api/sliders`)
  .then(response => {
    loading.value = false;
    sliders.value = response.data;
  })
  .catch(() => loading.value = false);

</script>
<template>
  <div v-if="loading" class="h-96 flex justify-center items-center">
    <Spinner />
  </div>
  <Carousel v-else :autoplay="5000" :items-to-show="1" :wrap-around="true" :pauseAutoplayOnHover="true">
    <Slide v-for="slide in sliders" :key="slide.id">
      <div class="h-full w-full flex justify-center items-center">
        <a :href="slide.url">
          <figure class="relative max-w transition-all duration-300 cursor-pointer">
            <img :src="slide.image" :alt="slide.image">
            <figcaption v-if="slide.image" class="absolute px-3 text-lg text-white bottom-8 left-4">
              <span class="bg-zhp-300 text-white text-2xl font-medium px-2 py-2 rounded">
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

<style>
.carousel__prev,
.carousel__next {
  color: #a6ce39;
  border: 1px solid #a6ce39;
  background-color: white;
  border-radius: 50%;
}
.carousel__prev:hover,
.carousel__next:hover {
  color: #78a22f;
  border: 1px solid #78a22f;
}
</style>
