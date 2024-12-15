import type { ApiConfig, ApiResponse, ApiErrorResponse } from './types';
import { ApiError, NetworkError, ValidationError } from './errors';

const defaultConfig: ApiConfig = {
  baseURL: import.meta.env.VITE_API_URL || '/api/v1',
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json'
  }
};

async function handleResponse<T>(response: Response): Promise<T> {
  if (!response.ok) {
    const errorData: ApiErrorResponse = await response.json().catch(() => ({
      message: response.statusText
    }));

    if (response.status === 422) {
      throw new ValidationError(errorData.message, errorData.errors || {});
    }

    throw new ApiError(
      errorData.message || response.statusText,
      response.status,
      errorData.errors
    );
  }

  const data: ApiResponse<T> = await response.json();
  return data.data;
}

export function createApiClient(config: Partial<ApiConfig> = {}) {
  const apiConfig = { ...defaultConfig, ...config };

  return {
    async get<T>(endpoint: string): Promise<T> {
      try {
        const response = await fetch(`${apiConfig.baseURL}${endpoint}`, {
          headers: apiConfig.headers
        });
        return handleResponse<T>(response);
      } catch (error) {
        if (error instanceof ApiError) throw error;
        throw new NetworkError();
      }
    },

    async post<T>(endpoint: string, data?: unknown): Promise<T> {
      try {
        const response = await fetch(`${apiConfig.baseURL}${endpoint}`, {
          method: 'POST',
          headers: apiConfig.headers,
          body: data ? JSON.stringify(data) : undefined
        });
        return handleResponse<T>(response);
      } catch (error) {
        if (error instanceof ApiError) throw error;
        throw new NetworkError();
      }
    }
  };
}