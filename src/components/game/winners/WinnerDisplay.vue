<script setup lang="ts">
import type { WinType } from '@/types/game';
import { useGameStore } from '@/stores/game';
import WinnerCard from './WinnerCard.vue';

const gameStore = useGameStore();
const { state } = gameStore;

const winTypes: WinType[] = ['ambo', 'terno', 'quaterna', 'cinquina', 'tombola'];
</script>

<template>
  <div class="space-y-4">
    <h2 class="text-2xl font-bold text-center">Winners</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
      <WinnerCard
        v-for="winType in winTypes"
        :key="winType"
        :win-type="winType"
        :winners="state.winners[winType]"
      />
    </div>
  </div>
</template>