<script setup>

import {permissions} from '@/Components/Admin/permissions';
import ContentAccess from '@/Components/Admin/ContentAccess.vue';
import {Link, usePage} from '@inertiajs/vue3';

const props = usePage().props.material;
</script>

<template>
  <ContentAccess :permissions="[permissions.MANAGE_MATERIALS]">
    <div
      class="w-full mt-4 xl:mt-0 max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6"
    >
      <h5 class="mb-3  lg:text-base font-semibold text-gray-900 md:text-xl">
        Opublikuj materiał
      </h5>
      <Link
        :href="route('admin.materials.change-status', [props.id, 'published'])"
        class=" font-medium text-white bg-blue-500 p-3 rounded hover:bg-blue-700 text-sm ml-3"
        title="Opublikuj teraz"
      >
        <font-awesome-icon icon="fa-solid fa-upload" /> Opublikuj teraz
      </Link>
    </div>
  </ContentAccess>
</template>
