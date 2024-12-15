<script setup lang="ts">
defineProps<{
  number: number | null
}>()
</script>

<template>
  <div class="bg-black p-8 rounded-lg shadow-inner">
    <div class="text-red-500 font-mono text-6xl font-bold led-effect">
      {{ number === null ? '--' : number.toString().padStart(2, '0') }}
    </div>
  </div>
</template>

<style scoped>
.led-effect {
  text-shadow: 0 0 10px rgba(239, 68, 68, 0.7);
}
</style>