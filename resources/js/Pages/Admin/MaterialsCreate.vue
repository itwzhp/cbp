<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
  <AdminLayout>
    <h2>Utwórz materiał</h2>
    <Link :href="route('admin.materials.new', 'program')">
      Program
    </Link>
    <Link :href="route('admin.materials.new', 'konspekt')">
      Konspekt
    </Link>
    <Link :href="route('admin.materials.new', 'propozycja')">
      Porpozycja
    </Link>
  </AdminLayout>
</template>
