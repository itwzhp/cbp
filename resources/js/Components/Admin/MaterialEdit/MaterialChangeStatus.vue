<script setup>
import {permissions} from '@/Components/Admin/permissions';
import ContentAccess from '@/Components/Admin/ContentAccess.vue';
import {Link} from '@inertiajs/vue3';

const props = defineProps({
    material: Object,
    status: { type: String, required: true },
    label: { type: String, required: true },
    title:  { type: String, required: false },
    icon: { type: Array, required: false },
});
</script>

<template>
  <ContentAccess :permissions="[permissions.MANAGE_MATERIALS]">
    <div
      class="w-full p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6"
    >
      <h5 class="mb-5 text-base font-semibold text-gray-900 md:text-xl">
        {{ props.label }}
      </h5>
      <Link
        :href="route('admin.materials.change-status', [props.material.id, props.status])"
        class=" font-medium text-white bg-blue-500 p-3 rounded hover:bg-blue-700 text-sm mt-2"
        :title="props.title"
      >
        <font-awesome-icon :icon="props.icon" /> {{ props.title }}
      </Link>
    </div>
  </ContentAccess>
</template>

<style scoped>

</style>
