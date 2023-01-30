<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
// import Carousel from '@/Components/Carousel.vue';
import CarouselSlider from '@/Components/CarouselSlider.vue';
</script>

<template>
  <Head title="Materiały" />
  <AuthenticatedLayout>
    <div class="py-2">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 md:py-3 md:px-0 border-b border-gray-200">
            <div>
              <h1 class="text-3xl">Strona główna - co tu ma być?</h1>
              <CarouselSlider />
              <!-- <Carousel /> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
