<script setup lang="ts">
defineProps<{
  numbers: number[];
  extractedNumbers: Set<number>;
}>();
</script>

<template>
  <div class="grid grid-cols-5 gap-2">
    <div
      v-for="number in numbers"
      :key="number"
      :class="[
        'p-2 text-center rounded transition-all',
        extractedNumbers.has(number)
          ? 'bg-primary text-primary-content'
          : 'bg-base-100'
      ]"
    >
      {{ number }}
    </div>
  </div>
</template>