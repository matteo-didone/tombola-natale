<script setup lang="ts">
import { useGameStore } from '@/stores/game';
import ExtractButton from './controls/ExtractButton.vue';
import LEDDisplay from './display/LEDDisplay.vue';
import NumberGrid from './board/NumberGrid.vue';
import PlayerSection from './players/PlayerSection.vue';
import WinnerDisplay from './winners/WinnerDisplay.vue';

const gameStore = useGameStore();
const { state } = gameStore;
</script>

<template>
  <div class="container mx-auto p-4 space-y-8">
    <h1 class="text-4xl font-bold text-center text-primary">
      Tombola di Natale
    </h1>
    
    <div class="flex flex-col items-center gap-4">
      <LEDDisplay :number="state.currentNumber" />
      <ExtractButton />
    </div>
    
    <NumberGrid :extracted-numbers="state.extractedNumbers" />
    
    <WinnerDisplay />
    
    <PlayerSection />
  </div>
</template>