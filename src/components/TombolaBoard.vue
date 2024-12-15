<script setup lang="ts">
import { ref } from 'vue'
import VirtualButton from './VirtualButton.vue'
import LEDDisplay from './LEDDisplay.vue'

const extractedNumber = ref<number | null>(null)
const extractedNumbers = ref<Set<number>>(new Set())

const extractNumber = () => {
  let newNumber: number
  do {
    newNumber = Math.floor(Math.random() * 90) + 1
  } while (extractedNumbers.value.has(newNumber))
  
  extractedNumber.value = newNumber
  extractedNumbers.value.add(newNumber)
}
</script>

<template>
  <div class="flex flex-col items-center gap-8 p-8">
    <h1 class="text-4xl font-bold text-red-600">Tombola di Natale</h1>
    
    <div class="flex flex-col items-center gap-4">
      <LEDDisplay :number="extractedNumber" />
      <VirtualButton @extract="extractNumber" />
    </div>
    
    <div class="grid grid-cols-10 gap-2 mt-8">
      <div
        v-for="n in 90"
        :key="n"
        :class="[
          'w-10 h-10 flex items-center justify-center rounded-full border-2',
          extractedNumbers.has(n)
            ? 'bg-red-600 text-white border-red-700'
            : 'border-gray-300'
        ]"
      >
        {{ n }}
      </div>
    </div>
  </div>
</template>