<script setup>
import { usePage } from '@inertiajs/vue3';
const props = defineProps({
  permissions: { type: Array, required: true },
});
const userPermissions = usePage().props?.auth?.permissions || [];

const accessGranted = () => {
  return props.permissions.some(permission => userPermissions.includes(permission))
}
</script>

<template>
  <slot v-if="accessGranted()" />
</template>
