import axios from 'axios';
import type { Card, Player, WinType } from '@/types/game';

const api = axios.create({
  baseURL: '/api/v1',
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json'
  }
});

export const gameApi = {
  extractNumber: async (): Promise<number> => {
    const { data } = await api.post<{ number: number }>('/extract');
    return data.number;
  },

  checkWin: async (playerId: string, winType: WinType): Promise<boolean> => {
    const { data } = await api.post<{ isWinner: boolean }>('/check-win', {
      playerId,
      winType
    });
    return data.isWinner;
  },

  joinGame: async (name: string): Promise<Player> => {
    const { data } = await api.post<{ player: Player }>('/players', { name });
    return data.player;
  },

  createCard: async (playerId: string): Promise<Card> => {
    const { data } = await api.post<{ card: Card }>('/cards', { playerId });
    return data.card;
  }
};