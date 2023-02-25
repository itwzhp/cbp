<script setup>
import {usePage, router} from '@inertiajs/vue3';
import vueFilePond from 'vue-filepond';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import 'filepond/dist/filepond.min.css';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome';
import axios from 'axios';

const material = usePage().props.material;
const token = usePage().props.token;
const permissions = usePage().props.permissions;

const FilePond = vueFilePond(
    FilePondPluginFileValidateType,
    FilePondPluginImagePreview
);

const deleteAttachment = (attachment) => {
    axios.delete(route('api.admin.materials.attachments.destroy', {
        material: attachment.material_id,
        attachment: attachment.id
    }))
        .then(() => {
            // TODO: to można zrobić jakoś lepiej?
            material.attachments = material.attachments.filter((item)=>{
                return item.id !== attachment.id;
            });
        });
}

const refreshFiles = () => {
    // TODO: to działało dopóki nie było w komponencie. Jak wyniosłem te attachments do komponentu, to przestało działać
    router.reload({only: ['material']});
}
</script>
<template>
  <ul>
    <li
      v-for="attachment in material.attachments"
      :key="attachment.id"
    >
      {{ attachment }}
      <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded text-xs">
        <FontAwesomeIcon
          icon="trash"
          @click="deleteAttachment(attachment)"
        />
      </button>
    </li>
  </ul>
  <FilePond
    v-if="permissions.includes('update')"
    ref="pond"
    name="attachments"
    label-idle="Dodaj pliki do swojego materiału"
    :server="{
      url: route('api.admin.materials.attachments.store', material.id),
      withCredentials: true,
      headers: {
        'X-CSRF-TOKEN': token,
      }
    }"
    :allow-multiple="true"
    @processfile="refreshFiles"
  />
</template>
