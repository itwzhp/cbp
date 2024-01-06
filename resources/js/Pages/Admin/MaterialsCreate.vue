<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import {Link, Head, usePage} from '@inertiajs/vue3';

let presets = usePage().props.presets
</script>

<template>
  <Head title="Utwórz nowy materiał" />

  <AdminLayout>
    <ul class="pl-4 list-none grid-cols-4 grid grid-flow-row">
      <li
        v-for="preset in presets"
        :key="preset['slug']"
        class=" text-center m-2"
      >
        <Link
          :href="route('admin.materials.new', preset['slug'])"
          class="text-center"
        >
          <img
            :src="preset['icon']"
            class="w-1/2 mx-auto"
          >
          {{ preset['name'] }}
        </Link>
      </li>
    </ul>
  </AdminLayout>
</template>
