<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Link} from '@inertiajs/inertia-vue3'
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <Link :href="route('materials.index')" class="text-sm"><i class="fa fa-chevron-left"></i> powrót</Link>
        </template>

        <div class="flex max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="w-3/4">
                <slot></slot>
            </div>
            <div class="w-1/4">
                <slot name="sidebar"></slot>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
