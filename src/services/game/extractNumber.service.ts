import { apiClient } from '../api/client';
import type { ExtractNumberResponse } from '@/types/api';

export const extractNumber = async (): Promise<number> => {
  const { data } = await apiClient.post<ExtractNumberResponse>('/api/v1/extract');
  return data.number;
};