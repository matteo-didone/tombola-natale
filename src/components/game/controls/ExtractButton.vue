<script setup lang="ts">
import { useExtraction } from '@/composables/game/useExtraction';
import LoadingSpinner from './LoadingSpinner.vue';

const { isDisabled, isExtracting, handleExtract } = useExtraction();
</script>

<template>
  <button
    @click="handleExtract"
    :disabled="isDisabled"
    class="btn btn-primary btn-lg rounded-full w-32 h-32 transition-all"
    :class="{ 'opacity-50 cursor-not-allowed': isDisabled }"
  >
    <LoadingSpinner v-if="isExtracting" />
    <span v-else>ESTRAI</span>
  </button>
</template>