<script setup>
import { router } from '@inertiajs/vue3';
import vueFilePond from 'vue-filepond';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import 'filepond/dist/filepond.min.css';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import axios from 'axios';

const FilePond = vueFilePond(FilePondPluginFileValidateType, FilePondPluginImagePreview);

const deleteAttachment = (attachment) => {
  axios
    .delete(
      route('api.admin.materials.attachments.destroy', {
        material: attachment.material_id,
        attachment: attachment.id
      })
    )
};

const refreshFiles = () => {
  router.reload({ only: ['material'] });
};
</script>
<template>
  <ul>
    <li
      v-for="attachment in $page.props.material.attachments"
      :key="attachment.id"
    >
      {{ attachment }}
      <button
        v-if="$page.props.permissions.includes('update')"
        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded text-xs"
        @click.prevent="deleteAttachment(attachment)"
      >
        <FontAwesomeIcon icon="trash" />
      </button>
    </li>
  </ul>
  <FilePond
    v-if="$page.props.permissions.includes('update')"
    ref="pond"
    name="attachments"
    label-idle="Dodaj pliki do swojego materiału"
    :server="{
      url: route('api.admin.materials.attachments.store', $page.props.material.id),
      withCredentials: true,
      headers: {
        'X-CSRF-TOKEN': $page.props.token
      }
    }"
    :allow-multiple="true"
    @processfile="refreshFiles"
  />
</template>
