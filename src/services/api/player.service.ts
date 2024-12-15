import { api } from './base';
import { API_ENDPOINTS } from './endpoints';
import type { JoinGameResponse, CreateCardResponse } from '@/types/api';
import type { Player, Card } from '@/types/game';

export const playerService = {
  joinGame: async (name: string): Promise<Player> => {
    const { data } = await api.post<JoinGameResponse>(
      API_ENDPOINTS.PLAYER.JOIN,
      { name }
    );
    return data.player;
  },

  createCard: async (playerId: string): Promise<Card> => {
    const { data } = await api.post<CreateCardResponse>(
      API_ENDPOINTS.PLAYER.CREATE_CARD,
      { playerId }
    );
    return data.card;
  }
};