<template>
  <div class="min-h-screen flex items-center justify-center bg-gray-900">
    <div class="max-w-md w-full space-y-8 bg-gray-800 p-10 rounded-xl shadow-lg">
      <div>
        <h2 class="mt-6 text-center text-3xl font-extrabold text-white">
          Crie sua conta
        </h2>
      </div>
      <form class="mt-8 space-y-6" @submit.prevent="handleRegister">
        <div class="rounded-md shadow-sm -space-y-px">
          <div>
            <label for="name" class="sr-only">Nome</label>
            <input
              id="name"
              name="name"
              type="text"
              required
              class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
              placeholder="Nome"
              v-model="name"
            />
          </div>
          <div>
            <label for="email-address" class="sr-only">Email</label>
            <input
              id="email-address"
              name="email"
              type="email"
              autocomplete="email"
              required
              class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
              placeholder="Email"
              v-model="email"
            />
          </div>
          <div>
            <label for="password" class="sr-only">Senha</label>
            <input
              id="password"
              name="password"
              type="password"
              autocomplete="new-password"
              required
              class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
              placeholder="Senha"
              v-model="password"
            />
          </div>
          <div>
            <label for="confirmPassword" class="sr-only">Confirmar Senha</label>
            <input
              id="confirmPassword"
              name="confirmPassword"
              type="password"
              required
              class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
              placeholder="Confirmar Senha"
              v-model="confirmPassword"
            />
          </div>
        </div>

        <div v-if="password !== confirmPassword" class="text-red-500 text-sm text-center">
          As senhas não coincidem
        </div>

        <div>
          <button
            type="submit"
            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            :disabled="password !== confirmPassword"
          >
            Registrar
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios' // Importando o axios para fazer as requisições

const name = ref('')
const email = ref('')
const password = ref('')
const confirmPassword = ref('')
const router = useRouter()

const handleRegister = async () => {
  // Verifica se as senhas coincidem
  if (password.value !== confirmPassword.value) {
    return
  }

  // Prepara os dados para o backend com o role fixado como 'user'
  const userData = {
    name: name.value,
    email: email.value,
    password: password.value,
    password_confirmation: confirmPassword.value,
    role: 'user' // Forçando o role como 'user'
  }

  try {
    // Envia a requisição para o backend
    const response = await axios.post('http://localhost:8000/api/register', userData, {
      headers: {
        'Content-Type': 'application/json'
      }
    })
    console.log(response.data)
    router.push('/login')
  } catch (error) {
    console.error('Erro no registro:', error.response ? error.response.data : error.message)
    // Exibir a mensagem de erro ao usuário, se necessário
  }
}
</script>
