<script setup lang="ts">
import { computed } from 'vue';
import { storeToRefs } from 'pinia';
import { useGameStore } from '@/stores/game';
import NumberCell from './NumberCell.vue';

const store = useGameStore();
const { state } = storeToRefs(store);

const numbers = Array.from({ length: 90 }, (_, i) => i + 1);
const extractedNumbers = computed(() => state.value.extractedNumbers);
</script>

<template>
  <div class="grid grid-cols-10 gap-2">
    <NumberCell
      v-for="n in numbers"
      :key="n"
      :number="n"
      :is-extracted="extractedNumbers.has(n)"
    />
  </div>
</template>