import { api } from './base';
import type { JoinGameResponse, CreateCardResponse } from '@/types/api';

export const playerApi = {
  joinGame: async (name: string) => {
    const { data } = await api.post<JoinGameResponse>('/players', { name });
    return data.player;
  },

  createCard: async (playerId: string) => {
    const { data } = await api.post<CreateCardResponse>('/cards', { playerId });
    return data.card;
  }
};