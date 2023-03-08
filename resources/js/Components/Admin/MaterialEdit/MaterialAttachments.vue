<script setup>
import { router } from '@inertiajs/vue3';
import { ref } from 'vue';
import vueFilePond from 'vue-filepond';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import 'filepond/dist/filepond.min.css';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import axios from 'axios';
import ContentAccess from '@/Components/Admin/ContentAccess.vue';
import { permissions } from '@/Components/Admin/permissions.js';

const FilePond = vueFilePond(FilePondPluginFileValidateType, FilePondPluginImagePreview);
const files = ref([]);
const refreshFiles = () => {
  router.reload({ only: ['material'] });
};

const deleteInProgressFileIndex = ref(null);
const deleteAttachment = (attachment, index) => {
  deleteInProgressFileIndex.value = index;
  axios
    .delete(
      route('api.admin.materials.attachments.destroy', {
        material: attachment.material_id,
        attachment: attachment.id
      })
    )
    .then(() => {
      deleteInProgressFileIndex.value = null;
      files.value = [];
      refreshFiles();
    })
    .catch(() => deleteInProgressFileIndex.value = null)
};
</script>
<template>
  <div class="flex justify-between text-sm font-semibold pb-2">
    <div>Załączniki</div>
    <div class="cursor-pointer">
      <span
        class="inline-flex max-h-6 items-center justify-center px-2 py-0.5 ml-3 text-sm font-bold text-gray-500 bg-gray-200 rounded"
      >-</span>
      <span class="flex-1 ml-3">Usuń sekcje</span>
    </div>
  </div>
  <div class="w-full bg-gray-50/50 bg-white border border-gray-200 rounded-lg p-3">
    <ul class="my-4 space-y-3">
      <li
        v-for="attachment in $page.props.material.attachments"
        :key="attachment.id"
      >
        <div class="md:flex justify-between text-sm p-2 text-base font-medium text-gray-900 rounded-lg bg-gray-100 group hover:shadow">
          <div class="md:flex items-center">
            <div>{{ attachment.name }}</div>
          </div>
          <div class="md:flex items-center">
            <a
              title="Pobierz załącznik"
              class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded text-xs mx-2"
              :href="attachment.download_url"
              target="_blank"
            >
              <FontAwesomeIcon icon="file-arrow-down" />
            </a>
            <ContentAccess :permissions="[permissions.UPDATE]">
              <button
                title="Usuń załącznik"
                :disabled="deleteInProgressFileIndex === attachment.id"
                :class="{'bg-red-500/50 hover:bg-red-500/50 cursor-wait': deleteInProgressFileIndex === attachment.id}"
                class="bg-red-500 hover:bg-red-700 text-white py-2 px-4 rounded text-xs mx-2"
                @click.prevent="deleteAttachment(attachment, attachment.id)"
              >
                <FontAwesomeIcon icon="trash" />
              </button>
            </ContentAccess>
          </div>
        </div>
      </li>
    </ul>
    <ContentAccess :permissions="[permissions.UPDATE]">
      <FilePond
        ref="pond"
        name="attachments"
        label-file-processing="Wysyłanie pliku"
        label-file-processing-complete="Ukończono wysyłanie pliku"
        label-tap-to-cancel="proszę czekać"
        label-tap-to-undo=""
        label-idle="Dodaj pliki do swojego materiału"
        :server="{
          url: route('api.admin.materials.attachments.store', $page.props.material.id),
          withCredentials: true,
          headers: {
            'X-CSRF-TOKEN': $page.props.token
          }
        }"
        :allow-multiple="true"
        :allow-remove="false"
        :allow-revert="false"
        :files="files"
        @processfile="refreshFiles"
      />
    </ContentAccess>
  </div>
</template>
