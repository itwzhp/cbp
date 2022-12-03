<script setup>

const props = defineProps({
    attachment: {type: Object, required: true}
})

const mimeToIcon = (mime) => {
    switch (mime){
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
}

</script>
<template>
    <div>
        <a :href="this.attachment.url" target="_blank">
            <h5><i class="fa-regular" :class="mimeToIcon(this.attachment.mime)"></i> {{ this.attachment.name }}</h5>
        </a>
        <div>{{ this.attachment }}</div>
    </div>
</template>

