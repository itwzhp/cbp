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
      <div class="md:flex md:flex-row h-72 sm:h-80 md:h-36 items-center max-w-7xl mx-auto pt-2 md:pt-0">
        <div class="flex basis-1/6 pt-4 md:p-4 justify-center md:justify-start">
          <a
            href="https://zhp.pl/"
          >
            <img
              src="/images/zhp_logo.svg"
              alt="cbp-logo"
              class="h-20 sm:h-full"
            >
          </a>
        </div>
        <div class="flex basis-2/6 p-4">
          <div>
            <p class="text-sm font-bold pb-2">
              CZY WIESZ, ŻE...
            </p>
            <p class="text-xs">
              Test test
            </p>
          </div>
        </div>
        <div class="flex basis-3/6 justify-center md:justify-end">
          <div class="my-auto">
            <img
              class="h-auto w-44"
              src="/images/wagggs-logo.png"
              alt="wosm-logo"
            >
          </div>
          <div class="my-auto">
            <img
              class="h-auto w-44"
              src="/images/wosm-logo.png"
              alt="wosm-logo"
            >
          </div>
        </div>
      </div>
    </div>
    <div class="flex justify-center pt-2.5 text-sm">
      <ul class="list-none">
        <li class="md:inline-block">
          <a
            href="https://zhp.pl/copyright"
            target="_blank"
            class="p-1 hover:underline"
          >Copyright© </a>1997-{{ year }} Związek Harcerstwa Polskiego
          <span class="invisible md:visible">|</span>
        </li>
        <li class="md:inline-block">
          <a
            href="https://zhp.pl/informacje-i-uwagi-prawne"
            target="_blank"
            class="p-1 hover:underline"
          >Informacje i uwagi prawne</a><span class="invisible md:visible">|</span>
        </li>
        <li class="md:inline-block">
          <a
            href="https://zhp.pl/rodo"
            target="_blank"
            class="p-1 hover:underline"
          >Polityka prywatności</a><span class="invisible md:visible">|</span>
        </li>
        <li class="md:inline-block">
          <a
            href="https://bip.zhp.pl/"
            target="_blank"
            class="p-1 hover:underline"
          >Biuletyn Informacji Publicznej</a><span class="invisible md:visible">|</span>
        </li>
        <li class="md:inline-block">
          <a
            href="https://zhp.pl/deklaracja-dostepnosci"
            target="_blank"
            class="p-1 hover:underline"
          >Deklaracja dostępności</a>
        </li>
      </ul>
    </div>
  </footer>
</template>
