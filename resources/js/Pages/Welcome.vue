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
                  Centralny Bank Pomysłów (CBP 2.0) to rozwijana przez Związek
                  Harcerstwa Polskiego przestrzeń gromadząca wartościowe materiały programowe i
                  kształceniowe z całej organizacji. Znajdziesz tu propozycje zbiórek, konspekty, gry,
                  artykuły i inspiracje wspierające pracę wychowawczą oraz rozwój kadry. Jednocześnie
                  CBP obejmuje także wybrane materiały z minionych lat, które mogą nie zawsze
                  odpowiadać współczesnym realiom, ale mogą być cenną inspiracją do tworzenia nowych
                  propozycji.
                  Nasze obecne działania skupiamy na dostosowaniu układu treści dostępnych w CBP do
                  zmodyfikowanego w 2026r. Harcerskiego Systemu Wychowawczego. Tak, aby jeszcze lepiej
                  wspierały one realizację jego założeń w drużynach i zespołach instruktorskich.
                </p>
                <br>
                <p>
                  Materiały udostępnione w naszym banku może przeglądać każdy. Aby dodać nowy
                  materiał, musisz być członkiem Związku Harcerstwa Polskiego. Do czasu wdrożenia
                  nowego systemu dodawania i recenzji materiałów, aby opublikować nowy materiał w CBP
                  2.0, należy go przesłać na adres: inspiracje@zhp.pl . Otrzymane materiały zostają
                  przez nas skierowane do recenzji, a po przekazaniu ich wyników autorowi (i
                  wprowadzeniu przez niego ewentualnych poprawek), publikujemy je w banku.
                </p>
                <br>
                <p>
                  Zachęcamy do dzielenia się materiałami powstałymi w ramach prób instruktorskich,
                  które stanowią istotną część dorobku organizacji. Jeśli przesyłany materiał jest
                  elementem próby harcmistrzowskiej, prosimy o uwzględnienie tej informacji w
                  wiadomości.
                </p>
                <br>
                <p>
                  CBP 2.0 jest wspólną przestrzenią nas wszystkich, którą stale rozwijamy i
                  udoskonalamy. Wiemy, że mimo wielu usprawnień mogą pojawiać się w niej błędy. Dzięki
                  Twoim uwagom możemy na bieżąco poprawiać działanie platformy i podnosić jakość
                  publikowanych treści. Dlatego przygotowaliśmy formularz, który pozwala je na bieżąco
                  zgłaszać:
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
