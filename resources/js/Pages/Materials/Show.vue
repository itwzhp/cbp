<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import Attachment from "@/Components/Attachment.vue";
</script>

<template>
    <Head title="Materials" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <a :href="route('materials.show', $page.props.material.slug)">{{ $page.props.material.title }}</a>
            </h2>
            <div v-html="$page.props.material.content"></div>

            <div>
                <h4 class="mt-3">Załączniki</h4>
                <Attachment v-for="attachment in $page.props.material.attachments" :attachment="attachment"></Attachment>
            </div>

        </template>
    </AuthenticatedLayout>
</template>
