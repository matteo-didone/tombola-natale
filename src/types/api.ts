interface ApiCard {
  riga1: number[];
  riga2: number[];
  riga3: number[];
}

export interface JoinGameResponse {
  player: Player;
}

export interface CreateCardResponse {
  card: ApiCard;
}