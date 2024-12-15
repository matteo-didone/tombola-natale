import axios from 'axios';
import { API_URL } from '@/config/constants';
import { HttpError } from '@/utils/errors';

export const createHttpClient = () => {
  const client = axios.create({
    baseURL: API_URL,
    headers: {
      'Content-Type': 'application/json',
      'Accept': 'application/json'
    }
  });

  client.interceptors.response.use(
    response => response,
    error => {
      if (!error.response) {
        throw new HttpError('Network error');
      }

      const message = error.response.data?.message || 'An unexpected error occurred';
      throw new HttpError(message, error.response.status, error.response.data);
    }
  );

  return client;
};