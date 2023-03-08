<script setup>
import { router } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import debounce from 'lodash.debounce';
import axios from 'axios';
import ContentAccess from '@/Components/Admin/ContentAccess.vue';
import { permissions } from '@/Components/Admin/permissions.js';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

const props = defineProps({
  attachment: { type: Object, required: true }
});

const collapsed = ref(true);
const changeCollapse = () => {
  collapsed.value = !collapsed.value;
};

const inputClasses = 'bg-gray-50/50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mb-2';
const colors = [
  { id: 'color', name: 'Kolor' },
  { id: 'black', name: 'Czarno-biały' }
];
const thicknesses = [
  { id: 'normal', name: 'Normalna' },
  { id: 'thick', name: 'Cienka' },
  { id: 'very_thick', name: 'Bardzo cienka' }
];
const sizes = [
  { id: 'A4', name: 'A4' },
  { id: 'A3', name: 'A3' },
  { id: 'A2', name: 'A2' },
  { id: 'A1', name: 'A1' },
  { id: 'A5', name: 'A5' },
  { id: 'A6', name: 'A6' },
  { id: 'OTHER', name: 'Inna' }
];

const element = ref(props.attachment.element);
const copies = ref(props.attachment.copies);
const print_color = ref(props.attachment.print_color);
const thickness = ref(props.attachment.thickness);
const size = ref(props.attachment.size);
const comment = ref(props.attachment.comment);
const paper_color = ref(props.attachment.paper_color);

const refreshFiles = () => {
  router.reload({ only: ['material'] });
};

watch(
  [element, copies, print_color, thickness, size, comment, paper_color],
  debounce(() => {
    updateAttachment();
  }, 1000)
);

const updateAttachment = () => {
  axios
    .post(
      route('api.admin.materials.attachments.update', {
        material: props.attachment.material_id,
        attachment: props.attachment.id,
      }),
      {
        element: element.value,
        copies: copies.value,
        print_color: print_color.value,
        thickness: thickness.value,
        size: size.value,
        comment: comment.value,
        paper_color: paper_color.value,
      }
    )
    .then(() => {
      refreshFiles();
    });
};
</script>
<template>
  <div class="w-full px-2">
    <p
      class="mb-1 font-medium"
      :class="{ 'cursor-pointer': props.allowHide }"
      @click="changeCollapse()"
    >
      <button class="text-sm px-1">
        Szczegóły załącznika
        <FontAwesomeIcon
          v-if="collapsed"
          icon="chevron-down"
        />
        <FontAwesomeIcon
          v-if="!collapsed"
          icon="chevron-up"
        />
      </button>
    </p>
    <div v-if="!collapsed">
      <ContentAccess :permissions="[permissions.UPDATE]">
        <label
          for="element"
          class="block mb-1 text-sm font-medium text-gray-900"
        >Element</label>
        <input
          id="element"
          v-model="element"
          type="text"
          :class="inputClasses"
          placeholder="Element"
          required
        >
        <label
          for="copies"
          class="block mb-1 text-sm font-medium text-gray-900"
        >Liczba kopii</label>
        <input
          id="copies"
          v-model="copies"
          type="number"
          :class="inputClasses"
          placeholder="Liczba kopii"
          required
        >
        <label
          for="print_color"
          class="block mb-1 text-sm font-medium text-gray-900"
        >Kolor druku</label>
        <select
          id="print_color"
          v-model="print_color"
          :class="inputClasses"
        >
          <option
            v-for="(value, key) in colors"
            :key="key"
            :value="value.id"
          >
            {{ value.name }}
          </option>
        </select>
        <label
          for="thickness"
          class="block mb-1 text-sm font-medium text-gray-900"
        >Grubość</label>
        <select
          id="thickness"
          v-model="thickness"
          :class="inputClasses"
        >
          <option
            v-for="(value, key) in thicknesses"
            :key="key"
            :value="value.id"
          >
            {{ value.name }}
          </option>
        </select>
        <label
          for="size"
          class="block mb-1 text-sm font-medium text-gray-900"
        >Rozmiar</label>
        <select
          id="size"
          v-model="size"
          :class="inputClasses"
        >
          <option
            v-for="(value, key) in sizes"
            :key="key"
            :value="value.id"
          >
            {{ value.name }}
          </option>
        </select>
        <label
          for="comment"
          class="block mb-1 text-sm font-medium text-gray-900"
        >Komentarz</label>
        <input
          id="comment"
          v-model="comment"
          type="text"
          :class="inputClasses"
          placeholder="Komentarz"
          required
        >
        <label
          for="paper_color"
          class="block mb-1 text-sm font-medium text-gray-900"
        >Kolor papieru</label>
        <input
          id="paper_color"
          v-model="paper_color"
          type="text"
          :class="inputClasses"
          placeholder="Komentarz"
          required
        >
      </ContentAccess>
    </div>
  </div>
</template>
