<script setup lang="ts">
import { ref } from 'vue';

const emit = defineEmits<{
  (e: 'extract'): void
}>();

const isPressed = ref(false);

const handleClick = () => {
  isPressed.value = true;
  emit('extract');
  setTimeout(() => {
    isPressed.value = false;
  }, 200);
};
</script>

<template>
  <button
    @click="handleClick"
    :class="[
      'btn btn-primary btn-lg rounded-full w-32 h-32',
      isPressed ? 'btn-active' : ''
    ]"
  >
    ESTRAI
  </button>
</template>