<script setup lang="ts">
import { ref } from 'vue';
import { usePlayerManagement } from '@/composables/usePlayerManagement';
import PlayerCard from '../cards/PlayerCard.vue';
import WinCheckButtons from './WinCheckButtons.vue';
import { useGameStore } from '@/stores/game';

const gameStore = useGameStore();
const { currentPlayer, isJoining, joinGame, createNewCard } = usePlayerManagement();
const playerName = ref('');

const handleJoin = () => {
  if (!playerName.value.trim()) return;
  joinGame(playerName.value);
};
</script>

<template>
  <div class="space-y-4">
    <div v-if="!currentPlayer" class="flex gap-2">
      <input
        v-model="playerName"
        type="text"
        placeholder="Enter your name"
        class="input input-bordered flex-1"
        :disabled="isJoining"
      />
      <button 
        @click="handleJoin" 
        class="btn btn-primary"
        :disabled="isJoining"
      >
        <span v-if="isJoining" class="loading loading-spinner"></span>
        <span v-else>Join Game</span>
      </button>
    </div>

    <div v-else class="space-y-4">
      <div class="flex justify-between items-center">
        <h2 class="text-xl font-bold">Welcome, {{ currentPlayer.name }}!</h2>
        <button @click="createNewCard" class="btn btn-secondary">
          Get New Card
        </button>
      </div>

      <WinCheckButtons :player-id="currentPlayer.id" />

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <PlayerCard
          v-for="card in currentPlayer.cards"
          :key="card.id"
          :card="card"
          :extracted-numbers="gameStore.state.extractedNumbers"
        />
      </div>
    </div>
  </div>
</template>