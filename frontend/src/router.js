import { createRouter, createWebHistory } from 'vue-router'
import Accueil from '../src/views/Acceuil.vue'
import Ajout from '../src/views/Ajout.vue'
import Liste from '../src/views/Liste.vue'
import Bilan from '../src/views/Bilan.vue'
import Login from '../src/views/login.vue'

const routes = [
  { path: '/', component: Accueil },
  { path: '/ajout', component: Ajout },
  { path: '/liste', component: Liste },
  { path: '/bilan', component: Bilan },
  { path: '/login', component: Login }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
