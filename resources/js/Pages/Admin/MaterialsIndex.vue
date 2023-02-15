<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import axios from 'axios';
import {onMounted} from 'vue';

onMounted(() => {
    axios.get('/api/admin/materials')
        .then((r) => {
            console.log(r.data);
        })
});
</script>

<template>
  <AdminLayout>
    Materials index
  </AdminLayout>
</template>
