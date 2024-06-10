<script setup>
import {usePage, Link, Head} from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import MaterialTextInput from '@/Components/Admin/MaterialEdit/MaterialTextInput.vue';
import MaterialFields from '@/Components/Admin/MaterialEdit/MaterialFields.vue';
import MaterialTags from '@/Components/Admin/MaterialEdit/MaterialTags.vue';
import MaterialLicence from '@/Components/Admin/MaterialEdit/MaterialLicence.vue';
import MaterialAttachments from '@/Components/Admin/MaterialEdit/MaterialAttachments.vue';
import MaterialSetups from '@/Components/Admin/MaterialEdit/MaterialSetups.vue';
import MaterialScenarios from '@/Components/Admin/MaterialEdit/MaterialScenarios.vue';
import MaterialChangeStatus from '@/Components/Admin/MaterialEdit/MaterialChangeStatus.vue';

const props = usePage().props.material;

const states = {
    draft: 'App\\Domains\\Materials\\States\\Draft',
    published: 'App\\Domains\\Materials\\States\\Published',
    archived: 'App\\Domains\\Materials\\States\\Archived',
};

const statuses = {
    published: 'published',
    draft: 'draft',
    archived: 'archived',
};
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
    <div class="block xl:flex">
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
      <div class="w-full basis-1/4 xl:px-4 flex flex-row xl:flex-col gap-4 mt-4 xl:mt-0">
        <MaterialChangeStatus
          v-if="props.state === states.draft"
          :material="usePage().props.material"
          :status="statuses.published"
          label="Opublikuj materiał"
          title="Opublikuj teraz"
          :icon="['fa-solid', 'fa-upload']"
        />

        <MaterialChangeStatus
          v-if="props.state === states.published"
          :material="usePage().props.material"
          :status="statuses.draft"
          label="Zmień na szkic"
          title="Zmień na szkic"
          :icon="['fas', 'pen-ruler']"
        />

        <MaterialChangeStatus
          v-if="props.state === states.published"
          :material="usePage().props.material"
          :status="statuses.archived"
          label="Zarchiwizuj materiał"
          title="Archiwizuj teraz"
          :icon="['fas', 'box-archive']"
        />

        <MaterialChangeStatus
          v-if="props.state === states.archived"
          :material="usePage().props.material"
          :status="statuses.draft"
          label="Zmień na szkic"
          title="Zmień na szkic"
          :icon="['fas', 'pen-ruler']"
        />
      </div>
    </div>
  </AdminLayout>
</template>
