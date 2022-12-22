<script setup>

const props = defineProps({
    attachment: {type: Object, required: true}
})

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
}

const details = new Map([
    ['copies', 'Liczba kopii'],
    ['print_color', 'Kolor wydruku'],
    ['thickness', 'Grubość kartki'],
    ['size', 'Wielkość kartki'],
    ['paper_color', 'Kolor papieru'],
    ['element', 'Element zajęć'],
    ['comment', 'Uwagi'],
]);
// const details = {
//     copies: 'Liczba kopii',
//     print_color: 'Kolor wydruku',
//     thickness: 'Grubość kartki',
//     size: 'Wielkość kartki',
//     paper_color: 'Kolor papieru',
//     element: 'Element zajęć',
//     comment: 'Uwagi',
// }

// const presentDetails = (attachment) => {
//     let present = {};

//     for (let detail in details){
//         if (attachment[detail])
//             present[detail] = attachment[detail];
//     }

//     return present;
// }

</script>
<template>
    <div class="flex items-center mb-3">
        <button class="w-11 h-11 rounded-full bg-gray-200 cursor-default">
            <i class="fa-regular" :class="mimeToIcon(this.attachment.mime)"></i>
        </button>
        <div class="pl-3">
            <div class="flex">
                <h5 class="font-semibold mr-5">{{ this.attachment.name }}</h5>
                <a :href="this.attachment.url" target="_blank">Pobierz</a>
            </div>
            <div class="flex gap-4 text-sm">
                <template v-for="(detail, key) in Object.keys(attachment)" :key="key">
                    <div v-if="details.get(detail) && attachment[detail]">
                         <span class="font-semibold">{{details.get(detail)}}:</span> {{attachment[detail]}}
                    </div>
                </template>
                <!-- <div class="flex gap-4 text-sm">
                    <div v-for="(detail, key) in presentDetails(attachment)">
                        <span class="font-semibold">{{ details[key] }}:</span> {{ detail }}
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</template>

