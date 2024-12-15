import { ref } from "vue";
import type { Player, Card } from "@/types/game";
import { playerService } from "@/services";
import { ApiError } from "@/services/api/base";

export function usePlayerManagement() {
  const currentPlayer = ref<Player | null>(null);
  const isJoining = ref(false);
  const error = ref<string | null>(null);

  const joinGame = async (name: string) => {
    if (isJoining.value || !name.trim()) return;

    isJoining.value = true;
    error.value = null;

    try {
      const player = await playerService.joinGame(name);
      currentPlayer.value = {
        ...player,
        cards: player.cards || [],
      };
    } catch (e) {
      error.value = e instanceof ApiError ? e.message : "Failed to join game";
      throw e;
    } finally {
      isJoining.value = false;
    }
  };

  const createNewCard = async () => {
    if (!currentPlayer.value) return;

    try {
      const card = await playerService.createCard(currentPlayer.value.id);
      if (currentPlayer.value) {
        if (!currentPlayer.value.cards) {
          currentPlayer.value.cards = [];
        }
        currentPlayer.value.cards.push(card);
      }
    } catch (e) {
      error.value = e instanceof ApiError ? e.message : "Failed to create card";
      throw e;
    }
  };

  return {
    currentPlayer,
    isJoining,
    error,
    joinGame,
    createNewCard,
  };
}