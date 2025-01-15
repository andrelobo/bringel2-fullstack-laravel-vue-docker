<template>
  <div class="min-h-screen bg-gray-900 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-gray-800 p-10 rounded-xl shadow-lg mx-auto">
      <div>
        <h2 class="mt-6 text-center text-3xl font-extrabold text-white">
          {{ isEditing ? 'Editar Produto' : 'Cadastrar Novo Produto' }}
        </h2>
      </div>
      <form class="mt-8 space-y-6" @submit.prevent="handleSubmit">
        <div v-if="errorMessage" class="text-red-500 text-sm mb-4">
          {{ errorMessage }}
        </div>
        <div>
          <label for="nome" class="sr-only">Nome do Produto</label>
          <input id="nome" name="nome" type="text" required
            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            placeholder="Nome do Produto" v-model="nome">
        </div>
        <div>
          <label for="descricao" class="sr-only">Descrição</label>
          <textarea id="descricao" name="descricao" required
            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            placeholder="Descrição" v-model="descricao"></textarea>
        </div>
        <div>
          <label for="preco" class="sr-only">Preço</label>
          <input id="preco" name="preco" type="number" step="0.01" required
            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            placeholder="Preço" v-model="preco">
        </div>
        <div>
          <label for="data_validade" class="sr-only">Data de Validade</label>
          <input id="data_validade" name="data_validade" type="date" required
            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            placeholder="Data de Validade" v-model="dataValidade">
        </div>
        <div>
          <label for="categoria" class="sr-only">Categoria</label>
          <select id="categoria" name="categoria" required
            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            v-model="categoriaId">
            <option value="">Selecione uma categoria</option>
            <option v-for="categoria in categorias" :key="categoria.id" :value="categoria.id">
              {{ categoria.nome }}
            </option>
          </select>
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
import { createProduto, updateProduto, getProdutoById, getCategorias } from '../api'

const route = useRoute()
const router = useRouter()
const nome = ref('')
const descricao = ref('')
const preco = ref(0)
const categoriaId = ref('')
const dataValidade = ref('')
const categorias = ref([])
const errorMessage = ref('')
const isEditing = ref(false)

onMounted(async () => {
  try {
    const response = await getCategorias()
    if (response.data.success) {
      categorias.value = response.data.data
    } else {
      errorMessage.value = 'Erro ao carregar categorias.'
    }

    if (route.params.id) {
      isEditing.value = true
      const produtoResponse = await getProdutoById(route.params.id)
      if (produtoResponse.data.success) {
        const produto = produtoResponse.data.data
        nome.value = produto.nome
        descricao.value = produto.descricao
        preco.value = parseFloat(produto.preco) || 0
        categoriaId.value = produto.categoria_id
        dataValidade.value = produto.data_validade.split('T')[0] // Formata para o formato `yyyy-MM-dd`
      } else {
        errorMessage.value = 'Erro ao carregar dados do produto.'
      }
    }
  } catch (error) {
    console.error('Erro ao carregar dados:', error)
    errorMessage.value = 'Erro ao carregar dados. Por favor, tente novamente.'
  }
})

const handleSubmit = async () => {
  errorMessage.value = '' // Limpar mensagem de erro anterior

  try {
    const produtoData = {
      nome: nome.value,
      descricao: descricao.value,
      preco: parseFloat(preco.value),
      categoria_id: categoriaId.value,
      data_validade: dataValidade.value,
    }

    if (isEditing.value) {
      const response = await updateProduto(route.params.id, produtoData)
      if (!response.data.success) throw new Error('Erro ao atualizar o produto.')
    } else {
      const response = await createProduto(produtoData)
      if (!response.data.success) throw new Error('Erro ao cadastrar o produto.')
    }

    router.push('/produtos')
  } catch (error) {
    console.error('Erro ao salvar produto:', error)

    if (error.response && error.response.status === 422) {
      const validationErrors = error.response.data.errors
      errorMessage.value = Object.values(validationErrors).flat().join(', ')
    } else {
      errorMessage.value = 'Erro ao salvar produto. Por favor, tente novamente.'
    }
  }
}
</script>
