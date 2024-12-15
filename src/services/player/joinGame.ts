import { http } from '../api/http';
import type { JoinGameResponse } from '@/types/api';
import type { Player } from '@/types/game';

export const joinGame = async (name: string): Promise<Player> => {
  const { data } = await http.post<JoinGameResponse>('/api/v1/players', { name });
  return data.player;
};