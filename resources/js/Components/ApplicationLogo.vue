<script setup>
import { Link } from '@inertiajs/vue3';
</script>
<template>
  <Link :href="route('welcome')">
    <img
      src="/images/cbp_logo.svg"
      alt="cbp-logo"
      class="h-16"
    >
  </Link>
</template>
