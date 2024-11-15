<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
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
                <p class="text-justify">
                  Centralny Bank Pomysłów (CBP 2.0) to przestrzeń pełna propozycji programowych,
                  pomysłów
                  na zbiórki, poradników, gier, artykułów czy inspiracji, których możesz użyć zarówno
                  w
                  pracy wychowawczej, jak i pracy z kadrą. Nowa odsłona CBP 2.0 powstawała kilka lat i
                  wiemy, że nie jest wolna od błędów. Dlatego przygotowaliśmy formularz, który pozwala
                  je
                  na bieżąco zgłaszać. Chcemy, by była to nasza wspólna przestrzeń, którą wspólnie
                  będziemy udoskonalać.
                </p>
                <p class="text-center py-6">
                  <a
                    href="https://forms.office.com/e/BCH22jmsCy"
                    target="_blank"
                    class="bg-transparent hover:bg-cbp-500 text-cbp-700 font-semibold hover:text-white py-2 px-4 border border-cbp-500 hover:border-transparent rounded"
                  >
                    ZGŁOŚ BŁĄD Z CBP 2.0
                  </a>
                </p>
                <p class="text-justify">
                  Materiały udostępnione w naszym banku może przeglądać każdy. Aby dodać nowy
                  materiał, musisz być członkiem Związku Harcerstwa Polskiego. Obecnie pracujemy nad
                  systemem umożliwiającym samodzielne dodawanie materiałów poprzez tą stronę. Do czasu
                  wdrożenia tej funkcjonalności, aby opublikować nowy materiał w CBP 2.0, należy go
                  przesłać na adres: <a
                    href="mailto:inspiracje@zhp.pl"
                    target="_blank"
                  >
                    inspiracje@zhp.pl
                  </a>. Otrzymane materiały zostaną przez nas
                  skierowane do recenzji, a po przekazaniu ich wyników autorowi (i wprowadzeniu przez
                  niego ewentualnych poprawek), opublikujemy je w banku. Jeśli materiał stanowi część
                  Twojej próby harcmistrzowskiej, prosimy o dodaniu tej informacji podczas przesyłania
                  materiałów do nas.
                </p>
                <p class="pt-2 text-justify">
                  Dodatkowo, jeśli jest to materiał do próby
                  harcmistrzowskiej, wspomnij o tym w wiadomości.
                </p>
              </div>

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
