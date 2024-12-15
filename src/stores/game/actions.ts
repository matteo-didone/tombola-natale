import type { Ref } from 'vue';
import type { GameState } from '@/types/game';
import { gameService } from '@/services';
import { HttpError } from '@/utils/errors';
import { updateState } from './mutations';
import { createInitialState } from './state';

export const createActions = (state: Ref<GameState>) => ({
  extract: async () => {
    if (state.value.isExtracting || state.value.extractedNumbers.size >= 90) {
      return;
    }

    updateState(state.value, {
      isExtracting: true,
      error: null
    });

    try {
      const number = await gameService.extractNumber();
      updateState(state.value, {
        currentNumber: number,
        extractedNumbers: new Set([...state.value.extractedNumbers, number])
      });
    } catch (error) {
      updateState(state.value, {
        error: error instanceof HttpError ? error.message : 'Failed to extract number'
      });
      throw error;
    } finally {
      updateState(state.value, {
        isExtracting: false
      });
    }
  },

  reset: () => {
    state.value = createInitialState();
  }
});