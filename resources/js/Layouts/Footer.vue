<script setup>
const today = new Date();
const year = today.getFullYear();
const showFooter = (currentRoute) =>
  !['materials.tag', 'materials.index'].some((route) => route === currentRoute);
</script>

<template>
  <footer
    v-if="showFooter(route().current())"
    ref="footer"
    class="flex flex-col bg-cbp-100 pt-4 pb-2.5 text-white print:hidden"
  >
    <div class="bg-cbp-300">
      <div class="md:flex md:flex-row h-40 md:h-36 items-center max-w-7xl mx-auto">
        <div class="flex basis-1/2 p-4">
          <div>
            <!-- <img style="opacity: 0.2; z-index: -1;" src="/images/questionmarks.svg" alt="questionmarks"> -->
            <p class="text-sm font-bold pb-2">CZY WIESZ, ŻE...</p>
            <p class="text-xs">
              Ponad 500 harcerzy z Polski w wakacje tego roku weźmie udział w USA w
              Światowym Jamboree Skautowe.
            </p>
          </div>
        </div>
        <div class="flex basis-1/2 justify-center md:justify-end">
          <div class="my-auto">
            <img class="h-auto w-44" src="/images/wagggs-logo.png" alt="wosm-logo" />
          </div>
          <div class="my-auto">
            <img class="h-auto w-44" src="/images/wosm-logo.png" alt="wosm-logo" />
          </div>
        </div>
      </div>
    </div>
    <div class="flex justify-center pt-2.5 text-sm">
      <ul class="list-none">
        <li class="md:inline-block">
          <a href="https://zhp.pl/copyright" target="_blank" class="p-1 hover:underline"
            >Copyright© </a
          >1997-{{ year }} Związek Harcerstwa Polskiego
          <span class="invisible md:visible">|</span>
        </li>
        <li class="md:inline-block">
          <a
            href="https://zhp.pl/informacje-i-uwagi-prawne"
            target="_blank"
            class="p-1 hover:underline"
            >Informacje i uwagi prawne</a
          ><span class="invisible md:visible">|</span>
        </li>
        <li class="md:inline-block">
          <a href="https://zhp.pl/rodo" target="_blank" class="p-1 hover:underline"
            >Polityka prywatności</a
          ><span class="invisible md:visible">|</span>
        </li>
        <li class="md:inline-block">
          <a href="https://bip.zhp.pl/" target="_blank" class="p-1 hover:underline"
            >Biuletyn Informacji Publicznej</a
          ><span class="invisible md:visible">|</span>
        </li>
        <li class="md:inline-block">
          <a
            href="https://zhp.pl/deklaracja-dostepnosci"
            target="_blank"
            class="p-1 hover:underline"
            >Deklaracja dostępności</a
          >
        </li>
      </ul>
    </div>
  </footer>
</template>
