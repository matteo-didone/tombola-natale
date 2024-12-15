import type { Player, Card } from './game';

export interface ApiResponse<T> {
  data: T;
  message?: string;
}

export interface ExtractNumberResponse {
  number: number;
}

export interface CheckWinResponse {
  isWinner: boolean;
}

export interface JoinGameResponse {
  player: Player;
}

export interface CreateCardResponse {
  card: Card;
}