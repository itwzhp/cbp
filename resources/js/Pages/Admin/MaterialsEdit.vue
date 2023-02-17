<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
</script>

<template>
  <AdminLayout>
    <h2>Edytuj materiał {{ $page.props.material.title }}</h2>
    {{ $page.props.material }}
  </AdminLayout>
</template>
