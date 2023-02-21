<script setup>
import { ref } from 'vue';
import { usePage } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import MaterialTextInput from '@/Components/Admin/MaterialEdit/MaterialTextInput.vue';

const props = usePage().props.material;
const newTitle = ref(null);
const newTitleSaved = (title) => {
  newTitle.value = title;
}

</script>

<template>
  <AdminLayout>
    <h2>Edytuj materiał</h2>
    <div>{{ newTitle || $page.props.material.title }}</div>
    <!-- {{ $page.props.material }} -->
    <form>
      <div class="mb-3">
        <MaterialTextInput
          field-name="title"
          field-label="Tytuł"
          @value-saved="newTitleSaved($event)"
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
    </form>
  </AdminLayout>
</template>
