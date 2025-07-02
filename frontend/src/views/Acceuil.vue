<template>
  <div class="container-fluid min-vh-100 bg-light">
    <!-- Titre principal -->
    <div class="text-center py-5">
      <h1 class="display-4 fw-bold text-primary">Gestion des Visiteurs</h1>
      <p class="lead text-muted">Portail d'administration</p>
    </div>

    <!-- Navigation sous forme de cartes -->
    <div class="row justify-content-center g-4 px-3">

      <!-- Carte Liste -->
      <div class="col-md-4">
        <router-link 
          to="/liste" 
          class="card h-100 text-decoration-none hover-shadow"
        >
          <div class="card-body text-center py-4">
            <div class="mx-auto bg-success bg-opacity-10 rounded-circle p-3 mb-3" style="width: 80px; height: 80px;">
              <i class="bi bi-people fs-3 text-success"></i>
            </div>
            <h3 class="card-title h4">Liste des Visiteurs</h3>
            <p class="card-text text-muted">Consultez et gérez les visiteurs</p>
          </div>
        </router-link>
      </div>

      
      <!-- Carte Ajout -->
      <div class="col-md-4">
        <router-link 
          to="/ajout" 
          class="card h-100 text-decoration-none hover-shadow"
        >
          <div class="card-body text-center py-4">
            <div class="mx-auto bg-primary bg-opacity-10 rounded-circle p-3 mb-3" style="width: 80px; height: 80px;">
              <i class="bi bi-person-plus fs-3 text-primary"></i>
            </div>
            <h3 class="card-title h4">Ajout de Visiteur</h3>
            <p class="card-text text-muted">Enregistrez un nouveau visiteur</p>
          </div>
        </router-link>
      </div>

      <!-- Carte Bilan -->
      <div class="col-md-4">
        <router-link 
          to="/bilan" 
          class="card h-100 text-decoration-none hover-shadow"
        >
          <div class="card-body text-center py-4">
            <div class="mx-auto bg-info bg-opacity-10 rounded-circle p-3 mb-3" style="width: 80px; height: 80px;">
              <i class="bi bi-bar-chart fs-3 text-info"></i>
            </div>
            <h3 class="card-title h4">Bilan Statistique</h3>
            <p class="card-text text-muted">Analyses et graphiques</p>
          </div>
        </router-link>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'HomeView'
}
</script>

<style scoped>
/* Effet de survol personnalisé */
.hover-shadow:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease;
}

/* Style pour le lien actif */
.router-link-exact-active {
  border: 2px solid var(--bs-primary);
}

/* Icônes Bootstrap */
@import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css");
</style>