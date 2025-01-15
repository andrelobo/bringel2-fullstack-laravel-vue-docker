import { createRouter, createWebHistory } from 'vue-router'
import LoginForm from './components/LoginForm.vue'
import RegisterForm from './components/RegisterForm.vue'
import CategoriaList from './components/CategoriaList.vue'
import CategoriaForm from './components/CategoriaForm.vue'
import ProdutoList from './components/ProdutoList.vue'
import ProdutoForm from './components/ProdutoForm.vue'
import UserList from './components/UserList.vue'

const routes = [
  { path: '/', redirect: '/login' },
  { path: '/login', component: LoginForm },
  { path: '/register', component: RegisterForm },
  { path: '/categorias', component: CategoriaList },
  { path: '/categorias/nova', component: CategoriaForm },
  { path: '/categorias/:id/editar', component: CategoriaForm },
  { path: '/produtos', component: ProdutoList },
  { path: '/produtos/novo', component: ProdutoForm },
  { path: '/produtos/:id/editar', component: ProdutoForm },
  { path: '/users', component: UserList },
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

router.beforeEach((to, from, next) => {
  const publicPages = ['/login', '/register']
  const authRequired = !publicPages.includes(to.path)
  const loggedIn = localStorage.getItem('token')

  if (authRequired && !loggedIn) {
    return next('/login')
  }

  next()
})

export default router

