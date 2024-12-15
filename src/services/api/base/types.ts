export interface ApiConfig {
  baseURL: string;
  headers: Record<string, string>;
}

export interface ApiResponse<T> {
  data: T;
  message?: string;
}

export interface ApiErrorResponse {
  message: string;
  errors?: Record<string, string[]>;
}