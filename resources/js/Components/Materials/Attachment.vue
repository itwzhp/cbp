<script setup>
const props = defineProps({
  attachment: { type: Object, required: true },
});

const mimeToIcon = (mime) => {
  switch (mime) {
    case 'application/pdf':
      return 'fa-file-pdf';
    case 'image/png':
    case 'image/jpeg':
      return 'fa-image';
    case 'application/zip':
    case 'application/x-rar':
      return 'fa-file-zipper';
    case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
    case 'application/msword':
    case 'application/vnd.oasis.opendocument.text':
      return 'fa-file-word';
    case 'application/vnd.ms-excel':
    case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
      return 'fa-file-spreadsheet';
    case 'application/vnd.openxmlformats-officedocument.presentationml.presentation':
    case 'application/vnd.ms-powerpoint':
      return 'fa-file-powerpoint';
    case 'video/mp4':
      return 'fa-file-video';
    default:
      return 'fa-file';
  }
};

const details = new Map([
  ['copies', 'Liczba kopii'],
  ['print_color', 'Kolor wydruku'],
  ['thickness', 'Grubość kartki'],
  ['size', 'Wielkość kartki'],
  ['paper_color', 'Kolor papieru'],
  ['element', 'Element zajęć'],
  ['comment', 'Uwagi'],
]);
</script>
<template>
  <div class="flex items-center mb-3">
    <button class="w-9 h-9 rounded-full bg-gray-200 cursor-default">
      <i
        class="fa-regular"
        :class="mimeToIcon(attachment.mime)"
      />
    </button>
    <div class="pl-3">
      <div class="flex">
        <h5 class="font-semibold mr-5">
          {{ attachment.name }}
        </h5>
        <a
          :href="attachment.url"
          target="_blank"
        >Pobierz</a>
      </div>
      <div class="flex gap-4 text-sm">
        <template
          v-for="(detail, key) in Object.keys(attachment)"
          :key="key"
        >
          <div v-if="details.get(detail) && attachment[detail]">
            <span class="font-semibold">{{ details.get(detail) }}:</span>
            {{ attachment[detail] }}
          </div>
        </template>
      </div>
    </div>
  </div>
</template>
