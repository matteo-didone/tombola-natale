import type { GameState } from '@/types/game';

export const createInitialState = (): GameState => ({
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