<script setup lang="ts">
import type { Player, WinType } from '@/types/game';

defineProps<{
  winType: WinType;
  winners: Player[];
}>();
</script>

<template>
  <div class="card bg-base-200">
    <div class="card-body">
      <h3 class="card-title capitalize">{{ winType }}</h3>
      <ul v-if="winners.length" class="list-disc list-inside">
        <li
          v-for="player in winners"
          :key="player.id"
        >
          {{ player.name }}
        </li>
      </ul>
      <p v-else class="text-base-content/70">No winners yet</p>
    </div>
  </div>
</template>