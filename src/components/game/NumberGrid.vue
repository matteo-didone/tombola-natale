<script setup lang="ts">
defineProps<{
  extractedNumbers: number[];
}>();
</script>

<template>
  <div class="grid grid-cols-10 gap-2">
    <div
      v-for="n in 90"
      :key="n"
      :class="[
        'w-10 h-10 flex items-center justify-center rounded-full',
        extractedNumbers.includes(n)
          ? 'bg-primary text-primary-content'
          : 'bg-base-200'
      ]"
    >
      {{ n }}
    </div>
  </div>
</template>