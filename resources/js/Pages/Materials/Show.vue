<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/inertia-vue3';
import Attachment from "@/Components/Attachment.vue";
</script>

<template>
    <Head title="Materials"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <a :href="route('materials.show', $page.props.material.slug)">{{ $page.props.material.title }}</a>
            </h2>
            <div v-html="$page.props.material.content"></div>

            <div class="mt-5">
                <div class="flex justify-between content-center items-center">
                    <h4 class="text-lg font-semibold mb-2">Załączniki do wydruku</h4>
                    <a :href="route('materials.download', $page.props.material.slug)">
                        <i class="fa fa-download"></i> Pobierz wszystkie załączniki
                    </a>
                </div>
                <Attachment v-for="(attachment, key) in $page.props.material.attachments"
                            :key="key" :attachment="attachment"></Attachment>

            </div>

        </template>
    </AuthenticatedLayout>
</template>
