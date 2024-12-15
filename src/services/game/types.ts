export interface ExtractNumberResponse {
  number: number;
}

export interface GameService {
  extractNumber(): Promise<number>;
}