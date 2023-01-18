<script setup>
import axios from "axios";
import fileDownload from 'js-file-download'
import {Head} from '@inertiajs/inertia-vue3';
import Attachment from "@/Components/Materials/Attachment.vue";
import TaxonomyBadge from "@/Components/Materials/TaxonomyBadge.vue";
import SidebarLayout from "@/Layouts/SidebarLayout.vue";
import {ref} from 'vue';
import Setup from "@/Components/Materials/Setup.vue";
import Scenario from "@/Components/Materials/Scenario.vue";
import Print from "@/Components/Print.vue";
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";
import AuthorsShort from "@/Components/Materials/AuthorsShort.vue";
import Authors from "@/Components/Materials/Authors.vue";
import Avatar from "@/Components/Avatar.vue";
import Spinner from "@/Components/Spinner.vue";
import Licence from "@/Components/Materials/Licence.vue";

let activeTab = ref(0);
const downloadInProgress = ref(false);

const setActiveTab = (id) => {
    activeTab.value = id;
}

const download = async (url) => {
    try {
        downloadInProgress.value = true;
        const request = await axios.get(url, {responseType: 'blob'});
        fileDownload(request.data, request.headers['content-disposition'].split('filename=')[1]);
        downloadInProgress.value = false;
    } catch (error) {
        downloadInProgress.value = false;
    }
}

</script>

<template>
    <Head :title="$page.props.material.title"/>

    <SidebarLayout>
        <template #default>

            <div class="w-full relative print:hidden">
                <img :src="$page.props.material.cover" class="w-full">
                <div class="absolute top-0 left-0 right-0 flex justify-between p-4">
                    <div>
                        <div class="rounded-full bg-gray-200 p-3 font-bold text-center">
                            {{$page.props.material.type }}
                        </div>
                    </div>
                    <Print>
                        <button class="w-11 h-11 rounded-full bg-gray-200">
                            <font-awesome-icon icon="fa-print"/>
                        </button>
                    </Print>
                </div>
            </div>
            <div class="p-6 print:p-1 flex justify-between align-middle border-b-2 border-gray-200">
                <div>
                    <img :src="$page.props.material.owner.avatar" class="inline-block w-6 h-6 rounded-full">
                    {{ $page.props.material.owner.name }}
                </div>
                <p class="text-base text-gray-500 text-sm">
                    <i class="fa fa-calendar text-gray-500"></i>
                    {{ $filters.dateFormat($page.props.material.published_at) }}
                </p>
            </div>

            <div class="p-6">
                <h2 class="font-semibold text-3xl text-gray-800 leading-tight font-medium mb-2">
                    <a :href="route('materials.show', $page.props.material.slug)">{{ $page.props.material.title }}</a>
                </h2>

                <div class="hidden print:block">
                    <AuthorsShort :fields="$page.props.material.fields"/>
                </div>
                <div>
                    <div class="flex mt-5 mb-3">
                        <div class="print:hidden flex-1 text-center font-bold border-b-2 cursor-pointer"
                             :class="activeTab == 0 ? 'border-zhp-700 text-zhp-700' : ''"
                             @click="setActiveTab(0)"
                        >
                            Informacje o publikacji
                        </div>
                        <div class="print:hidden flex-1 text-center font-bold border-b-2 cursor-pointer"
                             :class="activeTab == 1 ? 'border-zhp-700 text-zhp-700' : ''"
                             @click="setActiveTab(1)"
                        >
                            Konspekt i materiał
                        </div>
                    </div>

                    <div class="print:block" :class="{ hidden: activeTab !== 0}">
                        <div class="hidden print:flex mt-5 mb-3">
                            <div
                                class="flex-1 text-center font-bold border-b-2 cursor-pointer border-zhp-700 text-zhp-700">
                                Informacje o publikacji
                            </div>
                        </div>
                        <h3 class="text-lg font-bold mb-2 mt-4">Pełny opis</h3>
                        <div v-html="$page.props.material.content" class="py-3 text-justify"></div>

                        <TaxonomyBadge
                            v-for="(item, index) in $page.props.material.taxonomies"
                            :key="index"
                            :taxonomy="item"
                        ></TaxonomyBadge>

                    </div>

                    <div class="print:block" :class="{ hidden: activeTab !== 1}">
                        <div class="hidden print:flex mt-5 mb-3">
                            <div
                                class="flex-1 text-center font-bold border-b-2 cursor-pointer border-zhp-700 text-zhp-700">
                                Konspekt i materiał
                            </div>
                        </div>
                        <div v-if="$page.props.material.setups.length > 0">
                            <h3 class="text-lg font-bold mt-4 mb-2">
                                Informacje organizacyjne
                            </h3>
                            <Setup v-for="(setup, key) in $page.props.material.setups"
                                   :key="key"
                                   :setup="setup"
                            ></Setup>
                        </div>

                        <div v-if="$page.props.material.scenarios.length > 0">
                            <h3 class="text-lg font-bold mt-4 mb-2">
                                Przebieg
                            </h3>
                            <Scenario
                                v-for="(scenario, key) in $page.props.material.scenarios"
                                :itemId="key"
                                :scenario="scenario"
                            ></Scenario>
                        </div>

                        <div class="mt-5" v-if="$page.props.material.attachments.length > 0">
                            <div class="flex justify-between content-center items-center">
                                <h4 class="text-lg font-semibold mb-2">Załączniki do wydruku</h4>
                                <button @click="download(route('materials.download', $page.props.material.slug))"
                                        :disabled="downloadInProgress">
                                    <template v-if="downloadInProgress">
                                        <div class="grid grid-cols-4 gap-1 place-items-center">
                                            <div class="col-span-1">
                                                <Spinner width="6" height="6"/>
                                            </div>
                                            <div class="col-span-3 w-full">
                                                Trwa pobieranie
                                            </div>
                                        </div>
                                    </template>
                                    <template v-else>
                                        <div class="grid grid-cols-4 gap-1 place-items-end  print:hidden">
                                            <div class="col-span-1 mr-2">
                                                <i class="fa fa-download"></i>
                                            </div>
                                            <div class="col-span-3 w-full">
                                                Pobierz wszystkie załączniki
                                            </div>
                                        </div>
                                    </template>
                                </button>
                            </div>
                            <Attachment v-for="(attachment, key) in $page.props.material.attachments"
                                        :key="key" :attachment="attachment"
                            ></Attachment>
                        </div>
                    </div>

                </div>
            </div>
        </template>

        <template #sidebar>
            <div class="max-w-sm p-3 bg-white border border-gray-200 rounded-md shadow-sm ml-1">
                <Authors :fields="$page.props.material.fields"/>
                <hr class="mt-5 mb-5">
                <h3 class="text-lg font-bold">Cele Zrównoważonego Rozwoju</h3>
                <div class="grid grid-cols-3 gap-2 place-items-center mt-5 mb-5">
                    <Avatar imgSrc="https://cdn.pixabay.com/photo/2016/11/18/23/38/child-1837375__340.png"/>
                    <Avatar/>
                    <Avatar imgSrc="https://cdn.pixabay.com/photo/2016/11/18/23/38/child-1837375__340.png"/>
                </div>
            </div>
        </template>

    </SidebarLayout>
</template>
