import { api } from './base';
import type { ExtractNumberResponse, CheckWinResponse } from '@/types/api';

export const gameApi = {
  extractNumber: async () => {
    const { data } = await api.post<ExtractNumberResponse>('/extract');
    return data.number;
  },

  checkWin: async (playerId: string, winType: string) => {
    const { data } = await api.post<CheckWinResponse>('/check-win', {
      playerId,
      winType
    });
    return data.isWinner;
  }
};