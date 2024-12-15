<script setup lang="ts">
import type { Card } from '@/types/game';

defineProps<{
  card: Card;
  extractedNumbers: number[];
}>();
</script>

<template>
  <div class="card bg-base-200 shadow-xl">
    <div class="card-body">
      <div class="grid grid-rows-3 gap-2">
        <div
          v-for="(row, rowIndex) in card.rows"
          :key="rowIndex"
          class="grid grid-cols-5 gap-2"
        >
          <div
            v-for="(number, colIndex) in row"
            :key="colIndex"
            :class="[
              'p-2 text-center rounded',
              extractedNumbers.includes(number)
                ? 'bg-primary text-primary-content'
                : 'bg-base-100'
            ]"
          >
            {{ number }}
          </div>
        </div>
      </div>
    </div>
  </div>
</template>