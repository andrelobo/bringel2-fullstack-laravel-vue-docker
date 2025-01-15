<template>
  <div class="min-h-screen bg-gray-900 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-gray-800 p-10 rounded-xl shadow-lg mx-auto">
      <div>
        <h2 class="mt-6 text-center text-3xl font-extrabold text-white">
          {{ isEditing ? 'Editar Categoria' : 'Cadastrar Nova Categoria' }}
        </h2>
      </div>
      <form class="mt-8 space-y-6" @submit.prevent="handleSubmit">
        <div>
          <label for="nome" class="sr-only">Nome da Categoria</label>
          <input id="nome" name="nome" type="text" required
            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            placeholder="Nome da Categoria" v-model="nome">
        </div>
        <div>
          <button type="submit"
            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            {{ isEditing ? 'Atualizar' : 'Cadastrar' }}
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { createCategoria, updateCategoria, getCategoriaById } from '../api'

const route = useRoute()
const router = useRouter()
const nome = ref('')
const isEditing = ref(false)

onMounted(async () => {
  if (route.params.id) {
    isEditing.value = true
    try {
      const response = await getCategoriaById(route.params.id)
      nome.value = response.data.nome
    } catch (error) {
      console.error('Erro ao carregar categoria:', error)
    }
  }
})

const handleSubmit = async () => {
  try {
    if (isEditing.value) {
      await updateCategoria(route.params.id, { nome: nome.value })
    } else {
      await createCategoria({ nome: nome.value })
    }
    router.push('/categorias')
  } catch (error) {
    console.error('Erro ao salvar categoria:', error)
    // Adicione aqui a lógica para mostrar uma mensagem de erro ao usuário
  }
}
</script>

