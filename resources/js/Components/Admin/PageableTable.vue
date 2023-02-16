<script setup>
  import { onMounted, ref } from 'vue';
  import axios from 'axios';

  const materials = ref([]);
  const pagination = ref({current_page: 1});
  const paginationControls = ref([]);

  const calculatePaginationControls = (pagination) => {
    return {
      first: {
        pageNumber: pagination.current_page
      },
      middle: {
        pageNumber: pagination.current_page !== pagination.total_pages ? pagination.current_page + 1 : null
      },
      last: {
        pageNumber: ![pagination.current_page, pagination.current_page + 1, pagination.current_page + 2].some(page => page === pagination.total_pages) ?
        pagination.current_page + 2 :
        null
      }
    };
  }

  const requestData = (next, prev, pageNumber) => {
    let params = {};
    if (next) params.page = pagination.value.links.next.split('page=')[1];
    if (prev) params.page = pagination.value.links.previous.split('page=')[1];
    if (pageNumber) params.page = pageNumber;
      
    axios.get('/api/admin/materials', { params }).then((r) => {
      materials.value = r.data.data;
      pagination.value = r.data.meta.pagination;
      paginationControls.value = calculatePaginationControls(pagination.value);
    })
  }

  onMounted(() => {
    requestData();
  });

  const nextPage = () => {
    requestData(true);
  }

  const prevPage = () => {
    requestData(false, true);
  }

  const goToPage = (pageNumber) => {
    requestData(false, false, pageNumber);
  }

</script>
<template>
  <div class="relative shadow-md sm:rounded-lg">
    <div class="grid grid-cols-3 gap-4 p-2">
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
        <select
          id="small"
          class="block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        >
          <option value="all">
            Wszystkie
          </option>
          <option value="draft">
            Szkice
          </option>
          <option value="review">
            W trakcie recenzji
          </option>
          <option value="published">
            Opublikowane
          </option>
          <option value="archived">
            Odrzucone
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
      v-if="pagination.count"
      class="flex items-center justify-between p-2"
      aria-label="Table navigation"
    >
      <span class="text-sm font-normal text-gray-500 dark:text-gray-400">Wyniki 
        <span class="font-semibold text-gray-900 dark:text-white">
          {{ pagination.current_page === 1 ? 1 : pagination.current_page * pagination.count }}-{{ (pagination.current_page === 1 ? 1 : pagination.current_page + 1) * pagination.count }}</span> z <span class="font-semibold text-gray-900 dark:text-white">{{ pagination.total }}
        </span>
      </span>
      <ul class="inline-flex items-center -space-x-px">
        <li>
          <a
            v-if="pagination.links?.previous"
            class="cursor-pointer block px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
            @click="prevPage()"
          >
            <span class="sr-only">Poprzednia</span>
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
        <template v-if="pagination.current_page !==1">
          <li
            @click="goToPage(1)"
          >
            <a
              class="cursor-pointer px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
            >1</a>
          </li>
          <li>
            <a
              class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
            >...</a>
          </li>
        </template>
        
        <li>
          <a
            class="cursor-pointer z-10 px-3 py-2 leading-tight text-blue-600 border border-blue-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
          >{{ paginationControls.first.pageNumber }}</a>
        </li>
        <li @click="goToPage(paginationControls.middle.pageNumber)">
          <a
            v-if="paginationControls.middle.pageNumber"
            class="cursor-pointer px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
          >{{ paginationControls.middle.pageNumber }}</a>
        </li>
        <li @click="goToPage(paginationControls.last.pageNumber)">
          <a
            v-if="paginationControls.last.pageNumber"
            aria-current="page"
            class="cursor-pointer px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
          >{{ paginationControls.last.pageNumber }}</a>
        </li>
        <template v-if="pagination.total_pages !== pagination.current_page && paginationControls.middle.pageNumber !== pagination.total_pages">
          <li>
            <a
              class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
            >...</a>
          </li>
          <li @click="goToPage(pagination.total_pages)">
            <a
              href="#"
              class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
            >{{ pagination.total_pages }}</a>
          </li>
        </template>
        <li>
          <a
            v-if="pagination.links?.next"
            class="cursor-pointer block px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
            @click="nextPage()"
          >
            <span class="sr-only">Następna</span>
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
