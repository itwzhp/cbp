<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import {Head} from '@inertiajs/vue3';
</script>

<template>
  <Head title="Ustawienia" />
  <AdminLayout>
    <img :src="'data:image/jpeg;base64,'+$page.props.auth.photo">
  </AdminLayout>
</template>
