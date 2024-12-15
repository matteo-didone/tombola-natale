<script setup lang="ts">
const props = defineProps<{
  value: number | null;
}>();
</script>

<template>
  <span class="font-mono font-bold">
    {{ value === null ? '--' : String(value).padStart(2, '0') }}
  </span>
</template>