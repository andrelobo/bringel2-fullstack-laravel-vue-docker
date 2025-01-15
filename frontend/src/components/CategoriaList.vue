<template>
  <div class="min-h-screen bg-gray-900 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
      <h2 class="text-3xl font-extrabold text-white mb-6">Lista de Categorias</h2>
      <div v-if="errorMessage" class="bg-red-600 text-white px-4 py-3 rounded mb-4">
        {{ errorMessage }}
      </div>
      <div v-else class="bg-gray-800 shadow overflow-hidden sm:rounded-md">
        <ul v-if="categorias.length > 0" class="divide-y divide-gray-700">
          <li v-for="categoria in categorias" :key="categoria.id" class="px-6 py-4">
            <div class="flex items-center justify-between">
              <div class="text-sm font-medium text-white">{{ categoria.nome }}</div>
            </div>
          </li>
        </ul>
        <div v-else class="px-6 py-4 text-gray-400">
          Nenhuma categoria encontrada.
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { getCategorias } from '../api'

const categorias = ref([])
const errorMessage = ref('')

onMounted(async () => {
  try {
    const response = await getCategorias()
    console.log('Response da API:', response.data)
    if (response.data.success) {
      categorias.value = response.data.data
    } else {
      errorMessage.value = 'Erro ao carregar categorias. Resposta inesperada.'
    }
  } catch (error) {
    console.error('Erro ao buscar categorias:', error)
    errorMessage.value = 'Erro ao carregar categorias. Por favor, tente novamente mais tarde.'
  }
})
</script>
