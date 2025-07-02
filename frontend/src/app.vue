<template>
  <div class="app-container">
    <!-- En-tête -->
    <header class="app-header">
      <h1 class="app-title">Gestion des Visiteurs</h1>
      <nav class="app-nav">
        <router-link to="/" class="nav-link" active-class="active-link" exact>
          <i class="fas fa-home"></i> Accueil
        </router-link>
        <router-link to="/liste" class="nav-link" active-class="active-link">
          <i class="fas fa-list"></i> Liste
        </router-link>
        <router-link to="/ajout" class="nav-link" active-class="active-link">
          <i class="fas fa-user-plus"></i> Ajout
        </router-link>
        <router-link to="/bilan" class="nav-link" active-class="active-link">
          <i class="fas fa-chart-bar"></i> Bilan
        </router-link>
      </nav>
    </header>

    <!-- Contenu principal -->
    <main class="app-content">
      <router-view />
    </main>

    <!-- Pied de page -->
    <footer class="app-footer">
      <p>&copy; 2025 Gestion des Visiteurs</p>
    </footer>
  </div>
</template>

<script>
export default {
  name: 'App'
}
</script>

<style scoped>
.app-container {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.app-header {
  background-color: #2c3e50;
  color: white;
  padding: 1rem 2rem;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.app-title {
  margin: 0;
  font-size: 1.8rem;
  font-weight: 500;
}

.app-nav {
  display: flex;
  gap: 1.5rem;
  margin-top: 1rem;
  padding: 0.5rem 0;
}

.nav-link {
  color: #ecf0f1;
  text-decoration: none;
  font-size: 1rem;
  padding: 0.5rem 1rem;
  border-radius: 4px;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.nav-link:hover {
  background-color: rgba(255, 255, 255, 0.1);
}

.active-link {
  background-color: #3498db;
  color: white;
}

.app-content {
  flex: 1;
  padding: 2rem;
  background-color: #f5f7fa;
}

.app-footer {
  background-color: #2c3e50;
  color: white;
  text-align: center;
  padding: 1rem;
  font-size: 0.9rem;
}

hr {
  border: 0;
  height: 1px;
  background-color: #ddd;
  margin: 0;
}
</style>