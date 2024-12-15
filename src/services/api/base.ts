import axios from 'axios';
import type { AxiosError } from 'axios';

const API_URL = import.meta.env.VITE_API_URL || '/api';

export const api = axios.create({
  baseURL: API_URL,
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json'
  },
  withCredentials: true
});

export class ApiError extends Error {
  constructor(
    message: string,
    public status?: number,
    public errors?: Record<string, string[]>
  ) {
    super(message);
    this.name = 'ApiError';
  }
}

api.interceptors.response.use(
  response => response,
  (error: AxiosError) => {
    if (!error.response) {
      throw new ApiError('Network error occurred');
    }

    const message = error.response.data?.message || 'An unexpected error occurred';
    throw new ApiError(message, error.response.status);
  }
);