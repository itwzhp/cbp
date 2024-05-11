<script setup>
import {usePage, Link, Head} from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import MaterialTextInput from '@/Components/Admin/MaterialEdit/MaterialTextInput.vue';
import MaterialSections from '@/Components/Admin/MaterialEdit/MaterialSections.vue';
import MaterialFields from '@/Components/Admin/MaterialEdit/MaterialFields.vue';
import MaterialTags from '@/Components/Admin/MaterialEdit/MaterialTags.vue';
import MaterialLicence from '@/Components/Admin/MaterialEdit/MaterialLicence.vue';
import MaterialAttachments from '@/Components/Admin/MaterialEdit/MaterialAttachments.vue';
import MaterialSetups from '@/Components/Admin/MaterialEdit/MaterialSetups.vue';
import MaterialScenarios from '@/Components/Admin/MaterialEdit/MaterialScenarios.vue';
import MaterialPublish from '@/Components/Admin/MaterialEdit/MaterialPublish.vue';

const props = usePage().props.material;
</script>

<template>
  <Head title="Edytuj Materiał" />

  <AdminLayout>
    <button class="p-2 mb-2 hover:bg-gray-50 rounded-lg">
      <Link
        :href="route('admin.materials.index')"
        class="text-sm print:hidden"
      >
        <i class="fa fa-chevron-left" /> powrót
      </Link>
    </button>
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
            <MaterialFields type="author" />
          </div>
          <div class="mb-3">
            <MaterialFields type="proofreader" />
          </div>
          <div class="mb-3">
            <MaterialFields type="typesetter" />
          </div>
          <div class="mb-3">
            <MaterialFields type="translator" />
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
          <div class="mb-3">
            <MaterialSetups />
          </div>
          <div class="mb-3">
            <MaterialScenarios />
          </div>
          <div class="mb-3">
            <MaterialFields type="intent" />
          </div>
          <div class="mb-3">
            <MaterialFields type="scope" />
          </div>
          <div class="mb-3">
            <MaterialFields type="requirement" />
          </div>
        </div>
      </div>
      <div class="basis-1/4 md:px-4">
        <MaterialSections />
        <MaterialPublish />
      </div>
    </div>
  </AdminLayout>
</template>
