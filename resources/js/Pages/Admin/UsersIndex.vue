<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import {Head} from '@inertiajs/vue3';
import UsersTable from '@/Components/Admin/UsersTable.vue';
</script>

<template>
  <Head title="Użytkownicy" />

  <AdminLayout>
    <UsersTable />
  </AdminLayout>
</template>
