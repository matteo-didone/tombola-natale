import { computed } from 'vue';
import { useGameStore } from '@/stores/game';
import type { WinType } from '@/types/game';

export function useGameLogic() {
  const gameStore = useGameStore();
  const { state } = gameStore;

  const canExtract = computed(() => !state.value.isExtracting);
  const hasWinner = computed((winType: WinType) => state.value.winners[winType].length > 0);

  const handleExtraction = async () => {
    if (!canExtract.value) return;
    await gameStore.extractNumber();
  };

  const checkPlayerWin = async (playerId: string, winType: WinType) => {
    if (hasWinner.value(winType)) return false;
    return await gameStore.checkWin(playerId, winType);
  };

  return {
    state: computed(() => state.value),
    canExtract,
    hasWinner,
    handleExtraction,
    checkPlayerWin
  };
}