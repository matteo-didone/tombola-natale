import { api } from "./base";
import { API_ENDPOINTS } from "./endpoints";
import type { JoinGameResponse, CreateCardResponse } from "@/types/api";
import type { Player, Card } from "@/types/game";

const transformApiCardToCard = (apiCard: ApiCard): Card => {
  return {
    id: crypto.randomUUID(), // or however you're generating IDs
    rows: [apiCard.riga1, apiCard.riga2, apiCard.riga3],
  };
};

export const playerService = {
  joinGame: async (name: string): Promise<Player> => {
    const { data } = await api.post<JoinGameResponse>(
      API_ENDPOINTS.PLAYER.JOIN,
      { name }
    );
    return data.player;
  },

  createCard: async (playerId: string): Promise<Card> => {
    const { data } = await api.post<CreateCardResponse>(
      API_ENDPOINTS.PLAYER.CREATE_CARD,
      { playerId }
    );
    return transformApiCardToCard(data.card);
  },
};
