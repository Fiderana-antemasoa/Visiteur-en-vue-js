<template>
  <div class="container py-4">
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-6">
        <div class="card shadow">
          <div class="card-header bg-primary text-white">
            <h2 class="h4 mb-0"><i class="bi bi-person-plus me-2"></i>Ajouter un visiteur</h2>
          </div>
          
          <div class="card-body">
            <form @submit.prevent="ajouterVisiteur" class="needs-validation" novalidate>
              <div class="mb-3">
                <label for="nom" class="form-label">Nom complet</label>
                <input 
                  v-model="visiteur.nom" 
                  id="nom"
                  type="text" 
                  class="form-control"
                  placeholder="Entrez le nom du visiteur"
                  required
                >
                <div class="invalid-feedback">
                  Veuillez saisir un nom valide.
                </div>
              </div>

              <div class="mb-3">
                <label for="nb_jours" class="form-label">Nombre de jours</label>
                <input 
                  v-model.number="visiteur.nb_jours" 
                  id="nb_jours"
                  type="number" 
                  class="form-control"
                  min="1"
                  placeholder="Nombre de jours de visite"
                  required
                >
                <div class="invalid-feedback">
                  Veuillez saisir un nombre valide (minimum 1 jour).
                </div>
              </div>

              <div class="mb-4">
                <label for="tarif" class="form-label">Tarif journalier (Ar)</label>
                <div class="input-group">
                  <input 
                    v-model.number="visiteur.tarif_journalier" 
                    id="tarif"
                    type="number" 
                    class="form-control"
                    min="0"
                    step="0.01"
                    placeholder="Tarif par jour"
                    required
                  >
                  <span class="input-group-text">Ar/jour</span>
                </div>
                <div class="invalid-feedback">
                  Veuillez saisir un tarif valide.
                </div>
              </div>

              <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">
                  <i class="bi bi-save me-2"></i>Enregistrer
                </button>
              </div>
            </form>

            <div v-if="showNotification" class="notification fixed bottom-4 right-4 bg-green-500 text-white px-4 py-2 rounded shadow-lg z-50">
              {{ message }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      visiteur: { 
        nom: '', 
        nb_jours: '', 
        tarif_journalier: '' 
      },
      showNotification: false,
      message: ''
    }
  },
  methods: {
    async ajouterVisiteur() {
      const form = document.querySelector('.needs-validation')
      if (!form.checkValidity()) {
        form.classList.add('was-validated')
        return
      }

      try {
        const res = await fetch('http://localhost/VueJS/visiteurs_app/backend/add.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(this.visiteur)
        })
        
        const data = await res.json()
        this.message = data.message || 'Visiteur ajouté avec succès'
        this.showNotification = true
        
        // Réinitialiser le formulaire après succès
        if (!data.error) {
          this.visiteur = { nom: '', nb_jours: '', tarif_journalier: '' }
          form.classList.remove('was-validated')
        }
        
        // Disparition automatique du message après 5s
        setTimeout(() => {
            this.$router.push('/liste')
          }, 2000)

        setTimeout(() => {
          this.showNotification = false
          this.message = ''
        }, 3000)
        
      } catch (err) {
        console.error('Erreur:', err)
        this.message = "Erreur lors de l'ajout du visiteur"
      }
    }
  }
}
</script>

<style scoped>
.card {
  border-radius: 0.5rem;
}

.form-control:focus {
  border-color: #86b7fe;
  box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}

.invalid-feedback {
  display: none;
  width: 100%;
  margin-top: 0.25rem;
  font-size: 0.875em;
  color: #dc3545;
}

.was-validated .form-control:invalid ~ .invalid-feedback,
.was-validated .form-control:invalid:focus ~ .invalid-feedback {
  display: block;
}

.notification {
  animation: slideIn 0.5s forwards, fadeOut 0.5s 4.5s forwards;
}


@keyframes fadeOut {
  from { opacity: 1; }
  to { opacity: 0; }
}
</style>