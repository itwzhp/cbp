<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
</script>

<template>
    <Head title="Materials" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <a :href="route('materials.show', $page.props.material.slug)">{{ $page.props.material.title }}</a>
            </h2>

            <div v-html="$page.props.material.description"></div>
        </template>
    </AuthenticatedLayout>
</template>
