<script setup lang="ts">
import { ref } from 'vue'

const emit = defineEmits<{
  (e: 'extract'): void
}>()

const isPressed = ref(false)

const handleClick = () => {
  isPressed.value = true
  emit('extract')
  setTimeout(() => {
    isPressed.value = false
  }, 200)
}
</script>

<template>
  <button
    @click="handleClick"
    :class="[
      'w-32 h-32 rounded-full text-white font-bold shadow-lg transition-all',
      isPressed ? 'bg-red-700 scale-95' : 'bg-red-600 hover:bg-red-500'
    ]"
  >
    ESTRAI
  </button>
</template>