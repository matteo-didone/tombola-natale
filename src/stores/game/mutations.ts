import type { GameState } from '@/types/game';
import type { GameMutations } from './types';
import { createInitialState } from './state';

export function createMutations(state: GameState): GameMutations {
  return {
    setExtracting(value: boolean) {
      state.isExtracting = value;
    },

    setError(error: string | null) {
      state.error = error;
    },

    setNumber(number: number) {
      state.currentNumber = number;
      state.extractedNumbers.add(number);
    },

    resetState() {
      Object.assign(state, createInitialState());
    }
  };
}