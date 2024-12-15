<script setup lang="ts">
defineProps<{
  number: number;
  isExtracted: boolean;
}>();
</script>

<template>
  <div
    :class="[
      'w-10 h-10 flex items-center justify-center rounded-full transition-all',
      isExtracted
        ? 'bg-primary text-primary-content'
        : 'bg-base-200'
    ]"
  >
    {{ number }}
  </div>
</template>