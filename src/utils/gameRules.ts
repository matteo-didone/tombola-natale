import type { WinType } from '@/types/game';

export const WIN_CONDITIONS: Record<WinType, number> = {
  ambo: 2,
  terno: 3,
  quaterna: 4,
  cinquina: 5,
  tombola: 15
};

export const checkWinCondition = (
  extractedNumbers: Set<number>,
  cardNumbers: number[],
  winType: WinType
): boolean => {
  const matches = cardNumbers.filter(num => extractedNumbers.has(num));
  return matches.length >= WIN_CONDITIONS[winType];
};