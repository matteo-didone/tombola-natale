import axios from 'axios';
import type { WinType } from '@/types/game';

const API_URL = 'http://localhost:8000/api';

export const useGameService = () => {
  const extractNumber = async (): Promise<number> => {
    const response = await axios.post(`${API_URL}/extract`);
    return response.data.number;
  };

  const checkWin = async (playerId: string, winType: WinType): Promise<boolean> => {
    const response = await axios.post(`${API_URL}/check-win`, {
      playerId,
      winType
    });
    return response.data.isWinner;
  };

  const createCard = async () => {
    const response = await axios.post(`${API_URL}/cards`);
    return response.data.card;
  };

  return {
    extractNumber,
    checkWin,
    createCard
  };
};