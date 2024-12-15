<script setup lang="ts">
import type { WinType } from '@/types/game';
import { useGameStore } from '@/stores/game';

const gameStore = useGameStore();
const { state } = gameStore;

const winTypes: WinType[] = ['ambo', 'terno', 'quaterna', 'cinquina', 'tombola'];
</script>

<template>
  <div class="space-y-4">
    <h2 class="text-2xl font-bold text-center">Winners</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
      <div
        v-for="winType in winTypes"
        :key="winType"
        class="card bg-base-200"
      >
        <div class="card-body">
          <h3 class="card-title capitalize">{{ winType }}</h3>
          <ul v-if="state.winners[winType].length" class="list-disc list-inside">
            <li
              v-for="player in state.winners[winType]"
              :key="player.id"
            >
              {{ player.name }}
            </li>
          </ul>
          <p v-else class="text-base-content/70">No winners yet</p>
        </div>
      </div>
    </div>
  </div>
</template>