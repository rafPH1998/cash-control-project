import { createRouter, createWebHistory } from 'vue-router'
import index from './pages/index.vue'
import create from './pages/create.vue'

const routes = [
  {
    path: '/',
    name: 'index',
    component: index
  },
  {
    path: '/create',
    name: 'create',
    component: create
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
