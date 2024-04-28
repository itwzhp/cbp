<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import PageableTable from '@/Components/Admin/PageableTable.vue';
import {Head} from '@inertiajs/vue3';
</script>

<template>
  <Head title="Materiały" />

  <AdminLayout>
    <PageableTable />
  </AdminLayout>
</template>
