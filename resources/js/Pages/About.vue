<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/inertia-vue3";
</script>

<template>
    <Head title="O CBP"/>
    <AuthenticatedLayout>
        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 border-b border-gray-200">
                        <div>
                            <h1 class="text-3xl">O CBP</h1>
                        </div>
                        <p>Czy jakaś stopka?</p>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
