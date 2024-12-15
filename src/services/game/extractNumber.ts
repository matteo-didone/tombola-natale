import { http } from '../api/http';
import type { ExtractNumberResponse } from '@/types/api';

export const extractNumber = async (): Promise<number> => {
  const { data } = await http.post<ExtractNumberResponse>('/api/v1/extract');
  return data.number;
};