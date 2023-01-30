<script setup>
import { ref, onMounted } from 'vue'
import { Carousel, Pagination, Slide, Navigation } from 'vue3-carousel'
import SliderCard from "@/Components/SliderCard.vue";
import Spinner from "@/Components/Spinner.vue";

import 'vue3-carousel/dist/carousel.css'
const loading = ref(true);
const sliders = ref([]);
const itemsToShow = ref(5);
const breakpoints = new Map([
    // [640, 1],
    [768, 1],
    // [1024, 3],
    [1280, 3],
    [1536, 5]
]);
const calcItemsToShow = () => {
  const a = [...breakpoints.keys()].find(key => key >= window.innerWidth);
  itemsToShow.value = breakpoints.get(a) || 5;
};

calcItemsToShow(window.innerWidth);
onMounted(() => {
  addEventListener("resize", () => {
    calcItemsToShow();
  });
});

axios.get(`${import.meta.env.VITE_API_URL}/api/sliders`)
  .then(response => {
    loading.value = false;
    sliders.value = response.data;
  })
  .catch(() => loading.value = false);

</script>
<template>
  <div v-if="loading" class="text-center pt-2">
    <Spinner />
  </div>
  <Carousel v-else :autoplay="5000" :items-to-show="itemsToShow" :wrap-around="true" :pauseAutoplayOnHover="true">
    <Slide v-for="slide in sliders" :key="slide.id">
      <div class="carousel__item">
        <SliderCard :slide="slide" />
      </div>
    </Slide>

    <template #addons>
      <Navigation />
    </template>
  </Carousel>
</template>

<style>
.carousel__item {
  min-height: 200px;
  width: 100%;
  background-color: white;
  color: var(--vc-clr-white);
  font-size: 20px;
  border-radius: 8px;
  display: flex;
  justify-content: center;
  align-items: center;
  margin: 0 0.5rem;
}

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
