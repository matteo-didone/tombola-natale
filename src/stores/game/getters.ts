import type { Ref } from 'vue';
import { computed } from 'vue';
import type { GameState } from '@/types/game';

export const createGetters = (state: Ref<GameState>) => ({
  currentNumber: computed(() => state.value.currentNumber),
  isExtracting: computed(() => state.value.isExtracting),
  error: computed(() => state.value.error),
  extractedNumbers: computed(() => state.value.extractedNumbers),
  canExtract: computed(() => !state.value.isExtracting && state.value.extractedNumbers.size < 90)
});