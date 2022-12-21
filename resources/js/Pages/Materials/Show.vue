<script setup>
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

let activeTab = ref(0);

const setActiveTab = (id) => {
    activeTab.value = id;
}

</script>

<template>
    <Head title="Materials"/>

    <SidebarLayout>
        <template #default>

            <div class="w-full relative print:hidden">
                <img :src="$page.props.material.cover" class="w-full">
                <div class="absolute top-0 left-0 right-0 flex justify-between p-4">
                    <div>
                        <div class="rounded-full bg-gray-200 p-3 font-bold text-center">
                            Program
                        </div>
                    </div>
                    <Print>
                        <!-- // TODO: zrobić tę ikonkę realnie okrągłą i wyśrodkowaną -->
                        <div class="rounded-full bg-gray-200 p-3 w-11 h-11 text-center">
                            <font-awesome-icon icon="fa-print"/>
                        </div>
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

                <AuthorsShort :fields="$page.props.material.fields"/>

                <div>
                    <div class="flex mt-5 mb-3">
                        <div class="flex-1 text-center font-bold border-b-2 cursor-pointer"
                             :class="activeTab == 0 ? 'border-zhp-700 text-zhp-700' : ''"
                             @click="setActiveTab(0)"
                        >
                            Informacje o publikacji
                        </div>
                        <div class="flex-1 text-center font-bold border-b-2 cursor-pointer"
                             :class="activeTab == 1 ? 'border-zhp-700 text-zhp-700' : ''"
                             @click="setActiveTab(1)"
                        >
                            Konspekt i materiał
                        </div>
                    </div>

                    <!-- // TODO: na wersji do wydruku chcemy mieć albo tylko drugi tab widoczny, albo oba jeden pod drugim - doprecyzuję
                         // TODO: to z nimi, ale pewnie trzeba będzie tu zrobić jakiegoś miksa stylów z tailwinda zamiast tego v-if -->
                    <div v-if="activeTab === 0">
                        <h3 class="text-lg font-bold mb-2 mt-4">Pełny opis</h3>
                        <div v-html="$page.props.material.content" class="py-3 text-justify"></div>

                        <TaxonomyBadge
                            v-for="(item, index) in $page.props.material.taxonomies"
                            :key="index"
                            :taxonomy="item"
                        ></TaxonomyBadge>

                    </div>

                    <div v-if="activeTab === 1">

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


                        <div class="mt-5">
                            <div class="flex justify-between content-center items-center">
                                <h4 class="text-lg font-semibold mb-2">Załączniki do wydruku</h4>
                                <!-- todo: dodać spinner na przycisk pobierania wszystkich załączników - przygotowanie zipa może chwilę potrwać-->
                                <a :href="route('materials.download', $page.props.material.slug)">
                                    <i class="fa fa-download"></i> Pobierz wszystkie załączniki
                                </a>
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
            sidebar
        </template>

    </SidebarLayout>
</template>
