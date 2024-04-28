<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import {Head, Link} from '@inertiajs/vue3';
import {permissions} from '@/Components/Admin/permissions';
import ContentAccess from '@/Components/Admin/ContentAccess.vue';
</script>

<template>
  <Head title="Ustawienia" />
  <AdminLayout>
    <img :src="'data:image/jpeg;base64,'+$page.props.auth.photo">
    <ContentAccess :permissions="[permissions.MANAGE_USERS]">
      <Link :href="route('admin.settings.cache')">
        Wyczyść cache
      </Link>
    </ContentAccess>
  </AdminLayout>
</template>
