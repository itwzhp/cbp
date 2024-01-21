<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import {Head, Link} from '@inertiajs/vue3';
</script>

<template>
  <Head title="Ustawienia" />
  <AdminLayout>
    <img :src="'data:image/jpeg;base64,'+$page.props.auth.photo">
    <Link :href="route('admin.settings.cache')">
      Wyczyść cache
    </Link>
  </AdminLayout>
</template>
