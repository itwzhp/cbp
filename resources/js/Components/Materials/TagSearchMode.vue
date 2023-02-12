<script setup>
import { ref } from 'vue';
import { watch } from "@vue/runtime-core";

const props = defineProps({
    mode: { type: String, required: true }
});
const emit = defineEmits(['modeChanged']);
const mode = ref(props.mode);
watch(mode, (newValue) => {
    emit('modeChanged', newValue);
})
</script>

<template>
    <ul
        class="items-center w-full text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 sm:flex">
        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
            <div class="flex items-center pl-3 cursor-pointer">
                <input v-model="mode" id="horizontal-list-radio-license" type="radio" value="or" name="list-radio"
                    class="cursor-pointer w-4 h-4 text-cbp-500 bg-gray-100 border-gray-300 focus:ring-cbp-300">
                <label for="horizontal-list-radio-license"
                    class="cursor-pointer  py-3 ml-2 w-full text-sm font-medium text-gray-900">Lub</label>
            </div>
        </li>
        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
            <div class="flex items-center pl-3 cursor-pointer">
                <input v-model="mode" id="horizontal-list-radio-id" type="radio" value="and" name="list-radio"
                    class="cursor-pointer w-4 h-4 text-cbp-500 bg-gray-100 border-gray-300 focus:ring-cbp-300">
                <label for="horizontal-list-radio-id"
                    class="cursor-pointer py-3 ml-2 w-full text-sm font-medium text-gray-900">Oraz</label>
            </div>
        </li>
        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
            <div class="flex items-center pl-3 cursor-pointer">
                <input v-model="mode" id="horizontal-list-radio-millitary" type="radio" value="andor" name="list-radio"
                    class="cursor-pointer w-4 h-4 text-cbp-500 bg-gray-100 border-gray-300 focus:ring-cbp-300">
                <label for="horizontal-list-radio-millitary"
                    class="cursor-pointer py-3 ml-2 w-full text-sm font-medium text-gray-900">ANDOR</label>
            </div>
        </li>
    </ul>
</template>
