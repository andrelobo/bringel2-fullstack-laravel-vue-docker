<template>
  <div class="min-h-screen bg-gray-900 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
      <h2 class="text-3xl font-extrabold text-white mb-6">Lista de Usuários</h2>
      <div class="bg-gray-800 shadow overflow-hidden sm:rounded-md">
        <ul class="divide-y divide-gray-700">
          <li v-for="user in users" :key="user.id" class="px-6 py-4">
            <div class="flex items-center justify-between">
              <div class="text-sm font-medium text-white">{{ user.name }}</div>
              <div class="text-sm text-gray-400">{{ user.email }}</div>
              <div class="text-sm text-gray-400">{{ user.role }}</div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { getUsers } from '../api'

const users = ref([])

onMounted(async () => {
  try {
    const response = await getUsers()
    users.value = response.data
  } catch (error) {
    console.error('Erro ao carregar usuários:', error)
    // Adicione aqui a lógica para mostrar uma mensagem de erro ao usuário
  }
})
</script>

