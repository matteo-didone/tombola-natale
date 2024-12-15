import { apiClient } from '../api/client';
import type { ExtractNumberResponse } from './types';

export const gameService = {
  extractNumber: async (): Promise<number> => {
    const { data } = await apiClient.post<ExtractNumberResponse>('/extract');
    return data.number;
  }
};