import { defineStore } from 'pinia';
import { ref } from 'vue';
import type { GameState, WinType } from '@/types/game';
import { gameService } from '@/services';

const initialState: GameState = {
  extractedNumbers: new Set<number>(),
  currentNumber: null,
  players: [],
  winners: {
    ambo: [],
    terno: [],
    quaterna: [],
    cinquina: [],
    tombola: []
  },
  isExtracting: false,
  error: null
};

export const useGameStore = defineStore('game', () => {
  const state = ref<GameState>(initialState);

  const extract = async () => {
    if (state.value.isExtracting || state.value.extractedNumbers.size >= 90) {
      return;
    }

    state.value.isExtracting = true;
    state.value.error = null;

    try {
      const number = await gameService.extractNumber();
      state.value.currentNumber = number;
      state.value.extractedNumbers.add(number);
    } catch (error) {
      state.value.error = error instanceof Error ? error.message : 'Failed to extract number';
      throw error;
    } finally {
      state.value.isExtracting = false;
    }
  };

  const reset = () => {
    state.value = { ...initialState };
  };

  const checkWin = async (playerId: string | number, winType: WinType) => {
    // Implementation of win checking logic
    console.log(`Checking ${winType} win for player ${playerId}`);
    // Add your win checking logic here
  };

  return {
    state,
    extract,
    reset,
    checkWin
  };
});