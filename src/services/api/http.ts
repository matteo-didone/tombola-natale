import axios from 'axios';
import { API_URL } from '@/config/constants';

export const http = axios.create({
  baseURL: API_URL,
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json'
  }
});

export class HttpError extends Error {
  constructor(
    message: string,
    public status?: number,
    public data?: unknown
  ) {
    super(message);
    this.name = 'HttpError';
  }
}

http.interceptors.response.use(
  response => response,
  error => {
    if (!error.response) {
      throw new HttpError('Network error');
    }

    const message = error.response.data?.message || 'An unexpected error occurred';
    throw new HttpError(message, error.response.status, error.response.data);
  }
);