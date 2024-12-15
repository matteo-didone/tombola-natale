export interface Card {
  id: string;
  rows: number[][];
}

export interface Player {
  id: string;
  name: string;
  cards: Card[];
}

export type WinType = 'ambo' | 'terno' | 'quaterna' | 'cinquina' | 'tombola';

export interface GameState {
  extractedNumbers: Set<number>;
  currentNumber: number | null;
  players: Player[];
  winners: Record<WinType, Player[]>;
  isExtracting: boolean;
  error: string | null;
}