<script setup lang="ts">
import { useExtraction } from '@/composables/game/useExtraction';
import NumberDisplay from './NumberDisplay.vue';

const { currentNumber, error } = useExtraction();
</script>

<template>
  <div class="card bg-base-300 shadow-xl">
    <div class="card-body items-center text-center">
      <div class="text-6xl text-primary">
        <NumberDisplay :value="currentNumber" />
      </div>
      <div v-if="error" class="text-error mt-2">
        {{ error }}
      </div>
    </div>
  </div>
</template>