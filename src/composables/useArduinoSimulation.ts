import { ref } from 'vue';
import { useGameStore } from '@/stores/game';

export function useArduinoSimulation() {
  const gameStore = useGameStore();
  const isButtonPressed = ref(false);

  const simulateButtonPress = async () => {
    if (isButtonPressed.value) return;
    
    isButtonPressed.value = true;
    try {
      await gameStore.extractNumber();
    } finally {
      isButtonPressed.value = false;
    }
  };

  return {
    isButtonPressed,
    simulateButtonPress
  };
}