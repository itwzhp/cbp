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
              <h1 class="text-3xl font-semibold">Strona główna - co tu ma być?</h1>
              <CarouselSlider class="my-5" />
              <div class="mt-12">
                <h1 class="text-3xl font-semibold sm:w-1/2">Proponowane tematy</h1>
                <Topics class="my-5" />
              </div>
              <div class="mt-12">
                <h1 class="text-3xl font-semibold sm:w-1/2">
                  Aktualne propozycje programowe
                </h1>
                <h1 class="text-lg sm:w-1/2">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse
                  turpis arcu, consequat sit amet auctor sed, interdum nec metus.
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
