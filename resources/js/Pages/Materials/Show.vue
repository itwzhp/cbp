<script setup>
import {Head} from '@inertiajs/inertia-vue3';
import Attachment from "@/Components/Attachment.vue";
import TaxonomyBadge from "@/Components/TaxonomyBadge.vue";
import SidebarLayout from "@/Layouts/SidebarLayout.vue";
</script>

<template>
    <Head title="Materials"/>

    <SidebarLayout>
        <template #default>

            <div class="p-6 flex justify-between align-middle border-b-2 border-gray-200">
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
                <div v-html="$page.props.material.content"></div>

                <TaxonomyBadge
                    v-for="(item, index) in $page.props.material.taxonomies"
                    :key="index"
                    :taxonomy="item"
                ></TaxonomyBadge>

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

        </template>

        <template #sidebar>
            sidebar
        </template>

    </SidebarLayout>
</template>
