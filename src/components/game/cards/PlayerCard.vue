<script setup lang="ts">
import type { Card } from '@/types/game';
import CardRow from './CardRow.vue';

defineProps<{
  card: Card;
  extractedNumbers: Set<number>;
}>();
</script>

<template>
  <div class="card bg-base-200 shadow-xl">
    <div class="card-body">
      <div class="grid grid-rows-3 gap-2">
        <CardRow
          v-for="(row, index) in card.rows"
          :key="index"
          :numbers="row"
          :extracted-numbers="extractedNumbers"
        />
      </div>
    </div>
  </div>
</template>