<script setup lang="ts">
import { ref } from 'vue';
import type { Player } from '@/types/game';
import { useGameService } from '@/services/gameService';
import Card from './Card.vue';

const gameService = useGameService();
const playerName = ref('');
const player = ref<Player | null>(null);

const joinGame = async () => {
  if (!playerName.value.trim()) return;
  player.value = await gameService.joinGame(playerName.value);
};

const createNewCard = async () => {
  if (!player.value) return;
  const { card } = await gameService.createCard();
  player.value.cards.push(card);
};
</script>

<template>
  <div class="space-y-4">
    <div v-if="!player" class="flex gap-2">
      <input
        v-model="playerName"
        type="text"
        placeholder="Enter your name"
        class="input input-bordered"
      />
      <button @click="joinGame" class="btn btn-primary">Join Game</button>
    </div>

    <div v-else class="space-y-4">
      <div class="flex justify-between items-center">
        <h2 class="text-xl font-bold">Welcome, {{ player.name }}!</h2>
        <button @click="createNewCard" class="btn btn-secondary">
          Get New Card
        </button>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <Card
          v-for="card in player.cards"
          :key="card.id"
          :card="card"
        />
      </div>
    </div>
  </div>
</template>