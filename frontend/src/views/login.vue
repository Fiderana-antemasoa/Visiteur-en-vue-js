<template>
  <div class="container">
    <form @submit.prevent="login" class="form-box">
      <h2 class="title">Connexion</h2>

      <div class="form-group">
        <label for="pseudo">Pseudo</label>
        <input
          v-model="pseudo"
          type="text"
          id="pseudo"
          required
        />
      </div>

      <div class="form-group">
        <label for="password">Mot de passe</label>
        <input
          v-model="password"
          type="password"
          id="password"
          required
        />
      </div>

      <button type="submit" class="submit-btn">Se connecter</button>

      <p v-if="error" class="error">{{ error }}</p>
    </form>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'

const pseudo = ref('')
const password = ref('')
const error = ref('')
const router = useRouter()

const login = () => {
  if (pseudo.value === 'admin' && password.value === '1234') {
    error.value = ''
    router.push('/') // Redirection vers la route /liste
  } else {
    error.value = 'Pseudo ou mot de passe incorrect'
  }
}
</script>

<style scoped>
.container {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  background-color: #f3f3f3;
}

.form-box {
  background-color: white;
  padding: 2rem;
  border-radius: 8px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
  width: 100%;
  max-width: 400px;
}

.title {
  text-align: center;
  margin-bottom: 1.5rem;
  font-size: 1.5rem;
  font-weight: bold;
}

.form-group {
  margin-bottom: 1.2rem;
}

.form-group label {
  display: block;
  margin-bottom: 0.4rem;
  color: #333;
}

.form-group input {
  width: 100%;
  padding: 0.6rem;
  border: 1px solid #ccc;
  border-radius: 4px;
}

.submit-btn {
  width: 100%;
  background-color: #184992;
  color: white;
  padding: 0.7rem;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.submit-btn:hover {
  background-color: #2563eb;
}

.error {
  color: #e11d48;
  margin-top: 1rem;
  text-align: center;
  font-size: 0.9rem;
}
</style>
