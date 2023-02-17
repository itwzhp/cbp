<script setup>
import axios from 'axios';
import fileDownload from 'js-file-download';
import { Head } from '@inertiajs/vue3';
import Attachment from '@/Components/Materials/Attachment.vue';
import TaxonomyBadge from '@/Components/Materials/TaxonomyBadge.vue';
import SidebarLayout from '@/Layouts/SidebarLayout.vue';
import { ref } from 'vue';
import Setup from '@/Components/Materials/Setup.vue';
import Scenario from '@/Components/Materials/Scenario.vue';
import Print from '@/Components/Print.vue';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import AuthorsShort from '@/Components/Materials/AuthorsShort.vue';
import AuthorsCard from '@/Components/Materials/AuthorsCard.vue';
import Spinner from '@/Components/Spinner.vue';
import FieldsList from '@/Components/Materials/FieldsList.vue';

let activeTab = ref(0);
const downloadInProgress = ref(false);

const setActiveTab = (id) => {
  activeTab.value = id;
};

const download = async (url) => {
  try {
    downloadInProgress.value = true;
    const request = await axios.get(url, { responseType: 'blob' });
    fileDownload(
      request.data,
      request.headers['content-disposition'].split('filename=')[1]
    );
    downloadInProgress.value = false;
  } catch (error) {
    downloadInProgress.value = false;
  }
};

const filterFields = (fields, type)=>{
    let intents = fields.filter((group) => group.type === type);

    if (!intents || intents.length === 0)
        return [];

    return intents[0]['fields'];
}
</script>

<template>
  <Head :title="$page.props.material.title" />

  <SidebarLayout>
    <template #default>
      <div class="w-full relative print:hidden">
        <img
          :src="$page.props.material.cover"
          class="w-full"
        >
        <div class="absolute top-0 left-0 right-0 flex justify-between p-4">
          <div>
            <div class="rounded-full bg-gray-200 px-3 py-1 font-bold text-center text-sm">
              {{ $page.props.material.type }}
            </div>
          </div>
          <Print>
            <button class="w-11 h-11 rounded-full bg-gray-200">
              <font-awesome-icon icon="fa-print" />
            </button>
          </Print>
        </div>
      </div>
      <div
        class="p-6 print:p-1 flex justify-between align-middle border-b-2 border-gray-200"
      >
        <div>
          <img
            :src="$page.props.material.owner.avatar"
            class="inline-block w-6 h-6 rounded-full"
          >
          {{ $page.props.material.owner.name }}
        </div>
        <p class="text-base text-gray-500 text-sm">
          <i class="fa fa-calendar text-gray-500" />
          {{ $filters.dateFormat($page.props.material.published_at) }}
        </p>
      </div>

      <div class="p-6">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight font-medium mb-2">
          <a :href="route('materials.show', $page.props.material.slug)">{{
            $page.props.material.title
          }}</a>
        </h2>

        <div class="hidden print:block">
          <AuthorsShort :fields="$page.props.material.fields" />
        </div>
        <div>
          <div class="flex mt-5 mb-3">
            <div
              class="print:hidden flex-1 text-center font-bold border-b-2 cursor-pointer"
              :class="activeTab == 0 ? 'border-cbp-100 text-cbp-100' : ''"
              @click="setActiveTab(0)"
            >
              Informacje o publikacji
            </div>
            <div
              class="print:hidden flex-1 text-center font-bold border-b-2 cursor-pointer"
              :class="activeTab == 1 ? 'border-cbp-100 text-cbp-100' : ''"
              @click="setActiveTab(1)"
            >
              Konspekt i materiał
            </div>
          </div>

          <div
            class="print:block"
            :class="{ hidden: activeTab !== 0 }"
          >
            <div class="hidden print:flex mt-5 mb-3">
              <div
                class="flex-1 text-center font-bold border-b-2 cursor-pointer border-cbp-100 text-cbp-100"
              >
                Informacje o publikacji
              </div>
            </div>
            <h3 class="text-lg font-bold mb-2 mt-4">
              Pełny opis
            </h3>
            <div
              class="py-3 text-justify"
              v-html="$page.props.material.content"
            />

            <TaxonomyBadge
              v-for="(item, index) in $page.props.material.taxonomies"
              :key="index"
              :taxonomy="item"
            />

            <!-- TODO: jak to filtrowanie zrobić lepiej? W tabeli fields nie zawsze jest element z type intent-->
            <FieldsList :fields="filterFields($page.props.material.fields, 'intent')">
              Po zajęciach uczestniczka/uczestnik będzie:
            </FieldsList>

            <FieldsList :fields="filterFields($page.props.material.fields, 'requirement')">
              Realizowane wymagania z instrumentów metodycznych:
            </FieldsList>

            <FieldsList :fields="filterFields($page.props.material.fields, 'scope')">
              Zakres tematyczny:
            </FieldsList>
            <AuthorsCard class="md:hidden" />
          </div>

          <div
            class="print:block"
            :class="{ hidden: activeTab !== 1 }"
          >
            <div class="hidden print:flex mt-5 mb-3">
              <div
                class="flex-1 text-center font-bold border-b-2 cursor-pointer border-cbp-100 text-cbp-100"
              >
                Konspekt i materiał
              </div>
            </div>
            <div v-if="$page.props.material.setups.length > 0">
              <h3 class="text-lg font-bold mt-4 mb-2">
                Informacje organizacyjne
              </h3>
              <Setup
                v-for="(setup, key) in $page.props.material.setups"
                :key="key"
                :setup="setup"
              />
            </div>

            <div v-if="$page.props.material.scenarios.length > 0">
              <h3 class="text-lg font-bold mt-4 mb-2">
                Przebieg
              </h3>
              <Scenario
                v-for="(scenario, key) in $page.props.material.scenarios"
                :key="key"
                :item-id="key"
                :scenario="scenario"
              />
            </div>

            <div
              v-if="$page.props.material.attachments.length > 0"
              class="mt-5"
            >
              <div class="flex justify-between content-center items-center">
                <h4 class="text-lg font-semibold mb-2">
                  Załączniki do wydruku
                </h4>
                <button
                  :disabled="downloadInProgress"
                  @click="
                    download(route('materials.download', $page.props.material.slug))
                  "
                >
                  <template v-if="downloadInProgress">
                    <div class="grid grid-cols-4 gap-1 place-items-center">
                      <div class="col-span-1">
                        <Spinner
                          width="6"
                          height="6"
                        />
                      </div>
                      <div class="col-span-3 w-full">
                        Trwa pobieranie
                      </div>
                    </div>
                  </template>
                  <template v-else>
                    <div class="grid grid-cols-4 gap-1 place-items-end print:hidden">
                      <div class="col-span-1 mr-2">
                        <i class="fa fa-download" />
                      </div>
                      <div class="col-span-3 w-full">
                        Pobierz wszystkie załączniki
                      </div>
                    </div>
                  </template>
                </button>
              </div>
              <Attachment
                v-for="(attachment, key) in $page.props.material.attachments"
                :key="key"
                :attachment="attachment"
              />
            </div>
          </div>
        </div>
      </div>
    </template>

    <template #sidebar>
      <AuthorsCard />
    </template>
  </SidebarLayout>
</template>
