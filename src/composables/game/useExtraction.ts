import { computed } from 'vue';
import { storeToRefs } from 'pinia';
import { useGameStore } from '@/stores/game';

export function useExtraction() {
  const store = useGameStore();
  const { state } = storeToRefs(store);

  const isDisabled = computed(() => 
    state.value.isExtracting || 
    state.value.extractedNumbers.size >= 90
  );

  const handleExtract = async () => {
    if (!isDisabled.value) {
      await store.extract();
    }
  };

  return {
    currentNumber: computed(() => state.value.currentNumber),
    isExtracting: computed(() => state.value.isExtracting),
    error: computed(() => state.value.error),
    isDisabled,
    handleExtract
  };
}