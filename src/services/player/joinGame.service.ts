import { apiClient } from '../api/client';
import type { JoinGameResponse } from '@/types/api';
import type { Player } from '@/types/game';

export const joinGame = async (name: string): Promise<Player> => {
  const { data } = await apiClient.post<JoinGameResponse>('/api/v1/players', { name });
  return data.player;
};