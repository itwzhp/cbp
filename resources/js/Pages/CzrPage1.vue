<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
</script>

<template>
  <Head title="O CBP" />
  <AuthenticatedLayout>
    <div class="py-2">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 md:py-3 md:px-0 border-b border-gray-200">
            <div>
              <h1 class="text-3xl">
                Cele zrównoważonego rozwoju
              </h1>
            </div>
            <p class="mb-3 text-justify">
              <strong>Centralny Bank Pomysłów 2.0</strong> jest nową odsłoną platformą, na której
              publikujemy <strong>godne polecenia materiały wypracowywane na wszystkich szczeblach
                harcerskiej struktury</strong> dodawane bezpośrednio przez autorów.
            </p>
            <p class="mb-3 text-justify">
              <img
                src="/images/cbp_small.png"
                alt="CBP logo"
                class="float-left mr-3"
              >
            </p>
            <p class="mb-3 text-justify">
              Centralnym Bankiem Pomysłów zarządza Wydział Inspiracji i Poradnictwa Głównej Kwatery ZHP. W
              przypadku jakichkolwiek pytań, wątpliwości lub uwag napisz na: inspiracje[at]zhp.pl
              Mamy nadzieję, że nasza inicjatywa pozwoli wzajemności oddziaływań w ZHP wejść w XXI wiek pełen
              nowych rozwiązań technologicznych.
            </p>
            <p class="mt-5 italic">
              Najnowsza wersja Centralnego Banku Pomysłów powstała dzięki wsparciu finansowemu WWF.
            </p>
            <img
              src="/images/wwf.png"
              class="h-24"
            >
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
