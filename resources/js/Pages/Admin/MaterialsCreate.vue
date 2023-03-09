<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Link, Head } from '@inertiajs/vue3';
</script>

<template>
  <Head title="Utwórz nowy materiał" />

  <AdminLayout>
    <ul class="list-disc pl-4">
      <li>
        <Link :href="route('admin.materials.new', 'program')">
          Program
        </Link>
      </li>
      <li>
        <Link :href="route('admin.materials.new', 'konspekt')">
          Konspekt
        </Link>
      </li>
      <li>
        <Link :href="route('admin.materials.new', 'propozycja')">
          Propozycja
        </Link>
      </li>
    </ul>
  </AdminLayout>
</template>
