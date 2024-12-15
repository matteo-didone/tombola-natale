import { defineStore } from 'pinia';
import { ref } from 'vue';
import type { GameState } from './types';
import { gameService } from '@/services';
import { ApiError } from '@/services/api/base';

const createInitialState = (): GameState => ({
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
});

export const useGameStore = defineStore('game', () => {
  const state = ref<GameState>(createInitialState());

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
      console.error('Extraction error:', error);
      state.value.error = error instanceof ApiError ? error.message : 'Failed to extract number';
      throw error;
    } finally {
      state.value.isExtracting = false;
    }
  };

  const reset = () => {
    state.value = createInitialState();
  };

  return {
    state,
    extract,
    reset
  };
});