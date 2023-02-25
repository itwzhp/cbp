<script setup>
import {usePage, router} from '@inertiajs/vue3';
import vueFilePond from 'vue-filepond';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import 'filepond/dist/filepond.min.css';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';

const material = usePage().props.material;
const token = usePage().props.token;
const permissions = usePage().props.permissions;

const FilePond = vueFilePond(
    FilePondPluginFileValidateType,
    FilePondPluginImagePreview
);

const refreshFiles = () => {
    router.reload({only:['material']});
}
</script>
<template>
  <ul>
    <li
      v-for="attachment in material.attachments"
      :key="attachment.id"
    >
      {{ attachment }}
    </li>
  </ul>
  <FilePond
    v-if="permissions.includes('update')"
    ref="pond"
    name="attachments"
    label-idle="Dodaj pliki do swojego materiału"
    :server="{
      url: route('api.admin.materials.upload', material.id),
      withCredentials: true,
      headers: {
        'X-CSRF-TOKEN': token,
      }
    }"
    :allow-multiple="true"
    @processfile="refreshFiles"
  />
</template>
