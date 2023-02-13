<script setup>
import Authors from './Authors.vue';
import Avatar from '@/Components/Avatar.vue';
</script>

<template>
  <div
    class="max-w-sm p-3 bg-white border border-gray-200 rounded-md shadow-sm ml-1 print:hidden"
  >
    <Authors :fields="$page.props.material.fields" />
    <hr class="mt-5 mb-5">
    <h3 class="text-lg font-bold">
      Cele Zrównoważonego Rozwoju
    </h3>
    <div class="grid grid-cols-3 gap-2 place-items-center mt-5 mb-5">
      <Avatar
        img-src="https://cdn.pixabay.com/photo/2016/11/18/23/38/child-1837375__340.png"
      />
      <Avatar />
      <Avatar
        img-src="https://cdn.pixabay.com/photo/2016/11/18/23/38/child-1837375__340.png"
      />
    </div>
  </div>
</template>
