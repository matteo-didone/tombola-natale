import type { GameState } from '@/types/game';

export interface GameStore {
  state: GameState;
  extract(): Promise<void>;
  reset(): void;
}

export interface GameMutations {
  setExtracting(value: boolean): void;
  setError(error: string | null): void;
  setNumber(number: number): void;
  resetState(): void;
}