<script setup>
  import { onMounted, ref } from 'vue';
  import axios from 'axios';

  const materials = ref([{
    'id': 166,
    'slug': 'jak-uczyc-gier-i-zabaw',
    'title': 'Jak uczyć gier i zabaw?',
    'content': '<span dir="ltr">Gra lub zabawa jest elementem prawie każdej zbiórki. Niekiedy bywa i tak, że grom i zabawom poświęcona jest cała zbiórka </span><span dir="ltr">zastępu. Ale umiejętne prowadzenie gier i zabaw to też sztuka. Sztuka, której trzeba się nauczyć. Są pewne reguły uczenia </span><span dir="ltr">gier. Zapoznaj się z nimi i spróbuj postępować według nich, a przekonasz się, że nauka i organizacja gier nie jest wcale </span><span dir="ltr">sztuką trudną. Każda gra ma swoje przepisy i tylko wtedy “wychodzi”, kiedy wszyscy jej uczestnicy przestrzegają ich wiernie. </span><span dir="ltr">Ważne jest, aby biorący udział w grze dobrze rozumiał jej zasady i przepisy.</span>',
    'published_at': null,
    'author': 'AnnaPe',
    'thumb': 'https://zhpcbpprodstore.blob.core.windows.net/images/8/conversions/uczenie_w_dzialaniu-thumb.jpg',
    'cover': 'http://127.0.0.1:8000/images/scout_cover.jpg',
    'type': 'Poradnik'
  }]);

  onMounted(() => {
    axios.get('/api/admin/materials').then((r) => {
      console.log(r.data);
    })
  });

</script>
<template>
  <div class="relative shadow-md sm:rounded-lg">
    <div class="grid grid-cols-2 gap-4 p-2">
      <div>
        <select
          id="small"
          class="block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        >
          <option value="all">
            Wszystkie
          </option>
          <option value="reviewed">
            Recenzowane przeze mnie
          </option>
          <option value="creator">
            Tylko moje
          </option>
        </select>
      </div>
      <div>
        <div class="bg-white dark:bg-gray-900">
          <label
            for="table-search"
            class="sr-only"
          >Wyszukaj</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
              <svg
                class="w-5 h-5 text-gray-500 dark:text-gray-400"
                aria-hidden="true"
                fill="currentColor"
                viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg"
              ><path
                fill-rule="evenodd"
                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                clip-rule="evenodd"
              /></svg>
            </div>
            <input
              id="table-search"
              type="text"
              class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-full bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
              placeholder="Wyszukaj"
            >
          </div>
        </div>
      </div>
    </div>
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
          <th
            scope="col"
            class="p-4"
          >
            <div class="flex items-center">
              <input
                id="checkbox-all-search"
                type="checkbox"
                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
              >
              <label
                for="checkbox-all-search"
                class="sr-only"
              >checkbox</label>
            </div>
          </th>
          <th
            scope="col"
            class="px-6 py-3"
          >
            ID
          </th>
          <th
            scope="col"
            class="px-6 py-3"
          >
            Tytuł
          </th>
          <th
            scope="col"
            class="px-6 py-3"
          >
            Autor
          </th>
          <th
            scope="col"
            class="px-6 py-3"
          >
            Typ
          </th>
          <th
            scope="col"
            class="px-6 py-3"
          >
            Akcje
          </th>
        </tr>
      </thead>
      <tbody>
        <template v-if="materials.length">
          <tr
            v-for="(material, key) in materials"
            :key="key"
            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
          >
            <td class="w-4 p-4">
              <div class="flex items-center">
                <input
                  id="checkbox-table-search-1"
                  type="checkbox"
                  class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                >
                <label
                  for="checkbox-table-search-1"
                  class="sr-only"
                >checkbox</label>
              </div>
            </td>
            <th
              scope="row"
              class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
            >
              {{ material.id }}
            </th>
            <td class="px-6 py-4">
              {{ material.title }}
            </td>
            <td class="px-6 py-4">
              {{ material.author }}
            </td>
            <td class="px-6 py-4">
              {{ material.type }}
            </td>
            <td class="px-6 py-4">
              <a
                href="#"
                class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
              >Edytuj</a>
            </td>
          </tr>
        </template>
      </tbody>
    </table>
    <nav
      class="flex items-center justify-between p-2"
      aria-label="Table navigation"
    >
      <span class="text-sm font-normal text-gray-500 dark:text-gray-400">Wyniki <span class="font-semibold text-gray-900 dark:text-white">1-10</span> z <span class="font-semibold text-gray-900 dark:text-white">1000</span></span>
      <ul class="inline-flex items-center -space-x-px">
        <li>
          <a
            href="#"
            class="block px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
          >
            <span class="sr-only">Previous</span>
            <svg
              class="w-5 h-5"
              aria-hidden="true"
              fill="currentColor"
              viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg"
            ><path
              fill-rule="evenodd"
              d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
              clip-rule="evenodd"
            /></svg>
          </a>
        </li>
        <li>
          <a
            href="#"
            class="z-10 px-3 py-2 leading-tight text-blue-600 border border-blue-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
          >1</a>
        </li>
        <li>
          <a
            href="#"
            class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
          >2</a>
        </li>
        <li>
          <a
            href="#"
            aria-current="page"
            class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
          >3</a>
        </li>
        <li>
          <a
            href="#"
            class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
          >...</a>
        </li>
        <li>
          <a
            href="#"
            class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
          >100</a>
        </li>
        <li>
          <a
            href="#"
            class="block px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
          >
            <span class="sr-only">Next</span>
            <svg
              class="w-5 h-5"
              aria-hidden="true"
              fill="currentColor"
              viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg"
            ><path
              fill-rule="evenodd"
              d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
              clip-rule="evenodd"
            /></svg>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</template>
