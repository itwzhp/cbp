<script setup>
import Authors from './Authors.vue';
import Avatar from '@/Components/Avatar.vue';
import {Link} from '@inertiajs/vue3';
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
      <Link
        v-for="czrTag in $page.props.czr"
        :key="czrTag.id"
        :href="route('materials.tag', czrTag.slug)"
        :alt="czrTag.name"
      >
        <Avatar
          :img-src="czrTag.icon"
          :tooltip="czrTag.name"
        />
      </Link>
    </div>
  </div>
</template>
