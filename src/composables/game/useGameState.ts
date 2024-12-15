import { storeToRefs } from 'pinia';
import { useGameStore } from '@/stores/game';

export function useGameState() {
  const store = useGameStore();
  const { 
    currentNumber,
    isExtracting,
    error,
    extractedNumbers,
    canExtract
  } = storeToRefs(store);
  
  return {
    currentNumber,
    isExtracting,
    error,
    extractedNumbers,
    canExtract,
    extract: store.extract,
    reset: store.reset
  };
}