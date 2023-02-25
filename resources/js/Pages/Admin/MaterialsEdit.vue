<script setup>
import {usePage} from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import MaterialTextInput from '@/Components/Admin/MaterialEdit/MaterialTextInput.vue';
import MaterialSections from '@/Components/Admin/MaterialEdit/MaterialSections.vue';
import MaterialFields from '@/Components/Admin/MaterialEdit/MaterialFields.vue';
import MaterialTags from '@/Components/Admin/MaterialEdit/MaterialTags.vue';
import MaterialLicence from '@/Components/Admin/MaterialEdit/MaterialLicence.vue';
import MaterialAttachments from '@/Components/Admin/MaterialEdit/MaterialAttachments.vue';

const props = usePage().props.material;
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
            <MaterialAttachments />
          </div>
        </div>
      </div>
      <div class="basis-1/4 md:px-4">
        <MaterialSections />
      </div>
    </div>
  </AdminLayout>
</template>
