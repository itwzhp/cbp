<script setup>
import Authors from './Authors.vue';
import Avatar from '@/Components/Avatar.vue';
import {Link} from '@inertiajs/vue3';
</script>

<template>
  <div
    class="max-w-sm p-3 bg-white border border-gray-200 rounded-md shadow-sm ml-1 print:hidden"
  >
    <h3
      v-if="$page.props.methodics.length > 0"
      class="text-lg font-bold mb-2 mt-4"
    >
      Metodyka
    </h3>
    <div
      v-if="$page.props.methodics.length > 0"
      class="grid grid-cols-3 gap-2 place-items-center mt-5 mb-5"
    >
      <Link
        v-for="methodic in $page.props.methodics"
        :key="methodic.id"
        :href="route('materials.tag', methodic.slug)"
        :alt="methodic.name"
      >
        <Avatar
          :img-src="methodic.icon"
          :tooltip="methodic.name"
        />
      </Link>
    </div>

    <hr
      class="mt-5 mb-5"
    >
    <Authors :fields="$page.props.material.fields" />

    <hr class="mt-5 mb-5">
    <h3 class="text-lg font-bold">
      Licencja
    </h3>
    <a
      v-if="$page.props.material.licence"
      :href="$page.props.material.licence.url"
      target="_blank"
    >
      <img
        :src="$page.props.material.licence.icon"
        :alt="$page.props.material.licence.name"
      >
    </a>
    <div>
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
  </div>
</template>
