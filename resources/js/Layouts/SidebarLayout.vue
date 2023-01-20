<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Link} from '@inertiajs/inertia-vue3'
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <Link :href="route('materials.index')" class="text-sm print:hidden"><i class="fa fa-chevron-left"></i> powrót</Link>
        </template>

        <div class="flex max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 print:w-full print:p-0">
            <div class="w-full md:w-3/4 print:w-full">
                <slot></slot>
            </div>
            <div class="invisible md:visible w-0 md:w-1/4 print:hidden">
                <slot name="sidebar"></slot>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
