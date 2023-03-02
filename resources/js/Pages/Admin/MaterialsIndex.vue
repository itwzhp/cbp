<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import PageableTable from '@/Components/Admin/PageableTable.vue';
</script>

<template>
  <AdminLayout>
    <p class="my-4 text-base font-semibold text-gray-900 md:text-xl">
      Materiały
    </p>
    <PageableTable />
  </AdminLayout>
</template>
