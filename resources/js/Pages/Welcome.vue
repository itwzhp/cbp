<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Carousel from '@/Components/Carousel.vue';
import CarouselSlider from '@/Components/CarouselSlider.vue';
import Topics from '@/Components/Topics.vue';
import 'vue3-carousel/dist/carousel.css';
</script>

<template>
  <Head title="CBP" />
  <AuthenticatedLayout>
    <div class="py-2">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 md:py-3 md:px-0 border-b border-gray-200">
            <div>
              <CarouselSlider class="mb-5" />
              <div class="mt-12">
                <h1 class="text-3xl font-semibold sm:w-1/2">
                  Znajdź materiał
                </h1>
                <Topics class="my-5" />
              </div>
              <div class="mt-12">
                <h1 class="text-3xl font-semibold sm:w-1/2">
                  Zajrzyj do...
                </h1>
                <Carousel class="my-5" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
