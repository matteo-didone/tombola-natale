import { api } from './base';
import { API_ENDPOINTS } from './endpoints';
import type { ExtractNumberResponse } from '@/types/api';

export const gameService = {
  extractNumber: async (): Promise<number> => {
    const { data } = await api.post<ExtractNumberResponse>(
      API_ENDPOINTS.GAME.EXTRACT
    );
    return data.number;
  }
};