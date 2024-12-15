import axios from 'axios';
import { API_CONFIG } from './config';
import { ApiError } from './errors';

export const apiClient = axios.create(API_CONFIG);

apiClient.interceptors.response.use(
  response => response,
  error => {
    if (!error.response) {
      throw new ApiError('Network error occurred');
    }

    const message = error.response.data?.message || 'An unexpected error occurred';
    throw new ApiError(message, error.response.status);
  }
);