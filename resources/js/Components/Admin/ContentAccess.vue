<script setup>
import { usePage } from '@inertiajs/vue3';
const props = defineProps({
  permissions: { type: Array, required: true },
});
const authPermissions = usePage().props?.auth?.permissions || [];
const permissions = usePage().props?.permissions || [];
const userPermissions = [...permissions, ...authPermissions];

const accessGranted = () => {
  return props.permissions.some(permission => userPermissions.includes(permission))
}
</script>

<template>
  <slot v-if="accessGranted()" />
</template>
