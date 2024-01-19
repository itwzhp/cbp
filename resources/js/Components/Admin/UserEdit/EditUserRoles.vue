<script setup>
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome';
import axios from 'axios';

const props = defineProps(['roles', 'user']);

const isActive = (role) => {
    return props.user.roles.filter((r) => {
        return r.id === role.id;
    }).length > 0;
}

const toggleRole = (role) => {
    axios
        .post('/api/admin/users/'+props.user.id + '/roles', {
            'id': role.id
        })
        .then(() => {
            location.reload();
        });
}
</script>

<template>
  <div class="flex">
    <div
      v-for="role in props.roles"
      :key="role.id"
      class="p-1 mx-3 border rounded rounded-xl cursor-pointer"
      :class="isActive(role) ? 'border-zhp-900' : 'border-red-600'"
      @click="toggleRole(role)"
    >
      <FontAwesomeIcon
        v-if="isActive(role)"
        icon="fa-solid fa-check"
        class="text-zhp-600"
      />
      <FontAwesomeIcon
        v-else
        icon="fa-solid fa-times"
        class="text-red-600"
      />
      {{ role.name }}
    </div>
  </div>
</template>

<style scoped>

</style>
