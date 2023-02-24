<script setup>
import { usePage } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import MaterialTextInput from '@/Components/Admin/MaterialEdit/MaterialTextInput.vue';
import MaterialSections from '@/Components/Admin/MaterialEdit/MaterialSections.vue';
import MaterialFields from '@/Components/Admin/MaterialEdit/MaterialFields.vue';
import MaterialTags from '@/Components/Admin/MaterialEdit/MaterialTags.vue';
import MaterialLicence from '@/Components/Admin/MaterialEdit/MaterialLicence.vue';
const props = usePage().props.material;
import vueFilePond from 'vue-filepond';

// Import FilePond styles
import 'filepond/dist/filepond.min.css';

// Import FilePond plugins
// Please note that you need to install these plugins separately

// Import image preview plugin styles
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';

// Import image preview and file type validation plugins
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';

// Create component
const FilePond = vueFilePond(
    FilePondPluginFileValidateType,
    FilePondPluginImagePreview
);
</script>

<template>
  <AdminLayout>
    <h2>Edytuj materiał</h2>
    <div>{{ $page.props.material.title }}</div>
    <!-- {{ $page.props.material }} -->
    <div class="block md:flex md:flex-row">
      <div class="basis-3/4">
        <div class="w-full p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6">
          <div class="mb-3">
            <MaterialTextInput
              field-name="title"
              field-label="Tytuł"
            />
          </div>
          <div class="mb-3">
            <MaterialTextInput
              field-name="description"
              field-label="Opis"
            />
          </div>
          <div class="mb-3">
            <MaterialTextInput
              field-name="slug"
              field-label="Slug"
            />
          </div>
          <div class="mb-3">
            <MaterialFields />
          </div>
          <div class="mb-3">
            <MaterialTags />
          </div>
          <div class="mb-3">
            <MaterialLicence />
          </div>
          <div class="mb-3">
            <ul>
              <li
                v-for="attachment in $page.props.material.attachments"
                :key="attachment.id"
              >
                {{ attachment }}
              </li>
            </ul>
            <FilePond
              ref="pond"
              name="attachments"
              label-idle="Dodaj pliki do swojego materiału"
              :server="route('api.admin.materials.upload', $page.props.material.id)"
            />
          </div>
        </div>
      </div>
      <div class="basis-1/4 md:px-4">
        <MaterialSections />
      </div>
    </div>
  </AdminLayout>
</template>
