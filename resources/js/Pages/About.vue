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
                O CBP
              </h1>
            </div>
            <p class="mb-3 text-justify">
              <strong>Centralny Bank Pomysłów 2.0</strong> jest nową odsłoną platformą, na której
              publikujemy <strong>godne polecenia materiały wypracowywane na wszystkich szczeblach
                harcerskiej struktury</strong> dodawane bezpośrednio przez autorów.
            </p>
            <p class="text-justify">
              Pierwsza oficjalna odsłona CBP miała miejsce 1 września 2014 roku, kiedy to Bank stał się
              urzeczywistnieniem instruktorskich marzeń o wspólnej przestrzeni dla promowania inspiracji i
              dorobku instruktorskiego. Po 8 latach funkcjonowania platformy dostosowaliśmy ją do
              najnowszych rozwiązać technologicznych, rozwiązując jednocześnie pojawiające się coraz
              częściej problemy z przeglądaniem oraz dodawaniem materiałów.
            </p>
            <p class="mb-3 text-justify">
              Po miesiącach pracy programistów, przenoszenia i ponownej recenzji materiałów zawartych w
              pierwszej wersji Centralnego Banku Pomysłów z dumą oddajemy w Wasze ręce platformę na miarę
              obecnych czasów. Centralny Bank Pomysłów jest przestrzenią, która zbiera w jednym miejscu
              wszelkiego rodzaju <strong>materiały, które mogą stać się inspiracją</strong> dla innych członków ZHP, w tym:
              konspekty i gry programowe oraz kształceniowe, materiały wspierające kadrę czy też
              czasopisma o tematyce harcerskiej oraz propozycje programowe.
            </p>
            <p class="mb-3 text-justify">
              Dorobku ZHP nie tworzą tylko pracownicy i wolontariusze wydziałów Głównej Kwatery, jego równie
              ważną składową są materiały wypracowane przez poszczególnych instruktorów w ramach ich prób na
              stopnie. Aby przekazać dany materiał do CBP trzeba tylko <strong>zgody oraz gotowości autora, aby go
                wspólnymi siłami doszlifować.</strong>
            </p>
            <p class="mb-3 text-justify">
              <img
                src="/images/cbp_small.png"
                alt="CBP logo"
                class="float-left mr-3"
              >
              Myślą przewodnią CBP jest: Jakość ponad ilość. Zależy nam, aby to, co będziecie tu mogli
              znaleźć, ugruntowywało możliwie najlepsze wzorce. W związku z tym o wartości zamieszczonych w
              Banku opracowań świadczą nie tylko ich znakomici autorzy i redaktorzy, ale także współpracujący
              z Wydziałem Inspiracji i Poradnictwa Głównej Kwatery ZHP recenzenci. Każdy opublikowany tu
              materiał przechodzi weryfikację specjalisty w wybranej dziedzinie.
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
