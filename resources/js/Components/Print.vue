<script setup>
const print = () => {
    window.print();
}
</script>

<template>
    <div @click.prevent="print()" class="cursor-pointer print:hidden">
        <slot/>
    </div>
</template>
