<script setup lang="ts">
defineProps<{
  number: number | null;
}>();
</script>

<template>
  <div class="card bg-base-300 shadow-xl">
    <div class="card-body items-center text-center">
      <div class="text-6xl font-mono font-bold text-primary">
        {{ number === null ? '--' : number.toString().padStart(2, '0') }}
      </div>
    </div>
  </div>
</template>