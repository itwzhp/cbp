<script setup>
import { Link } from '@inertiajs/vue3';
</script>
<template>
  <Link :href="route('welcome')">
    <img src="/cbp-logo.png" alt="cbp-logo" class="h-16" />
  </Link>
</template>
