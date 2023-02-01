<script setup>
import Topic from "@/Components/Topic.vue";
</script>

<template>
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4">
    <template v-if="$page.props.topics">
      <Topic v-for="topic in $page.props.topics" :key="topic.id" :topic="topic"></Topic>
    </template>
  </div>
</template>
