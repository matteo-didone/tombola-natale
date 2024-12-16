<script setup lang="ts">
import { useGameStore } from '@/stores/game';
import type { WinType } from '@/types/game';
import { WIN_TYPES } from '@/config/constants';

const props = defineProps<{
  playerId: string | number;
}>();

const gameStore = useGameStore();
const { checkWin } = gameStore;

const handleWinCheck = async (winType: WinType) => {
  await checkWin(props.playerId, winType);
};
</script>

<template>
  <div class="flex flex-wrap gap-2">
    <button
      v-for="(label, type) in WIN_TYPES"
      :key="type"
      @click="handleWinCheck(type as WinType)"
      class="btn btn-outline btn-sm capitalize"
    >
      Check {{ type }}
    </button>
  </div>
</template>