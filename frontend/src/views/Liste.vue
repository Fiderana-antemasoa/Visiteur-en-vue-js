<template>
  <div class="container py-4">
    <div class="card shadow-sm">
      <div class="card-header bg-primary text-white">
        <h3 class="card-title mb-0">Liste des visiteurs</h3>
      </div>
      
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover table-bordered">
            <thead class="table-light">
              <tr>
                <th class="align-middle">Nom</th>
                <th class="text-center align-middle">Nb jours</th>
                <th class="text-center align-middle">Tarif jour (Ar)</th>
                <th class="text-center align-middle">Tarif total (Ar)</th>
                <th class="text-center align-middle">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="v in visiteurs" :key="v.id">
                <td class="align-middle">
                  <input 
                    v-model="v.nom" 
                    @input="(e) => validateName(e, v)"
                    @keydown="(e) => preventNumberInput(e)"
                    @paste="(e) => handlePaste(e, v)"
                    class="form-control form-control-sm"
                  >
                </td>
                <td class="text-center align-middle">
                  <input type="number" v-model.number="v.nb_jours" 
                         class="form-control form-control-sm text-center" min="1">
                </td>
                <td class="text-center align-middle">
                  <input type="number" v-model.number="v.tarif_journalier" 
                         class="form-control form-control-sm text-center" min="0" step="0.01">
                </td>
                <td class="text-center align-middle">
                  {{ (v.nb_jours * v.tarif_journalier).toFixed(2) }}
                </td>
                <td class="text-center align-middle">
                  <button @click="modifier(v)" class="btn btn-sm btn-outline-primary me-2">
                    <i class="bi bi-pencil"></i> Modifier
                  </button>
                  <button @click="supprimer(v.id)" class="btn btn-sm btn-outline-danger">
                    <i class="bi bi-trash"></i> Supprimer
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <div v-if="showNotification" 
            class="notification fixed bottom-4 left-1/2 transform -translate-x-1/2 bg-green-500 text-white px-4 py-2 rounded shadow-lg z-50"
            :class="notificationClass">
          {{ notificationMessage }}
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      visiteurs: [],
      showNotification: false,
      notificationMessage: '',
      notificationType: 'success'
    }    
  },

  computed: {
    notificationClass() {
      return {
        'bg-green-500': this.notificationType === 'success',
        'bg-red-500': this.notificationType === 'error'
      }
    }
  },

  async created() {
    await this.fetchVisiteurs();
    // Nettoyage initial des données existantes
    this.visiteurs.forEach(v => {
      v.nom = this.sanitizeName(v.nom);
    });
  },

  methods: {
    sanitizeName(name) {
      return name.replace(/[^a-zA-ZÀ-ÿ\s]/g, '').trim();
    },

    async fetchVisiteurs() {
      try {
        const res = await fetch('http://localhost/VueJS/visiteurs_app/backend/list.php');
        const json = await res.json();

        if (!Array.isArray(json)) {
          throw new Error("La réponse n'est pas un tableau");
        }

        this.visiteurs = json.map(v => ({
          ...v,
          nom: this.sanitizeName(v.nom),
          nb_jours: parseInt(v.nb_jours) || 0,
          tarif_journalier: parseFloat(v.tarif_journalier) || 0
        }));
      } catch (err) {
        console.error('Erreur lors du chargement des visiteurs :', err);
        this.showError('Erreur lors du chargement des visiteurs');
      }
    },

    validateName(event, visiteur) {
      visiteur.nom = this.sanitizeName(event.target.value);
    },

    preventNumberInput(event) {
      if (event.key >= '0' && event.key <= '9') {
        event.preventDefault();
      }
    },

    handlePaste(event, visiteur) {
      event.preventDefault();
      const pasteData = event.clipboardData.getData('text');
      visiteur.nom = this.sanitizeName(pasteData);
    },

    showError(message) {
      this.showNotification = true;
      this.notificationMessage = message;
      this.notificationType = 'error';
      setTimeout(() => this.showNotification = false, 3000);
    },

    async modifier(v) {
      if (!/^[a-zA-ZÀ-ÿ\s]{2,}$/.test(v.nom)) {
        this.showError('Le nom doit contenir uniquement des lettres (min 2 caractères)');
        return;
      }

      if (confirm("Êtes-vous sûr de vouloir modifier ce visiteur ?")) {
        try {
          const res = await fetch('http://localhost/VueJS/visiteurs_app/backend/update.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
              ...v,
              nom: this.sanitizeName(v.nom) // Nettoyage final avant envoi
            })
          });
          
          const data = await res.json();
          if (!data.success) throw new Error(data.message || 'Erreur serveur');

          this.showNotification = true;
          this.notificationMessage = data.message || 'Modification réussie';
          this.notificationType = 'success';

          setTimeout(() => {
            this.fetchVisiteurs();
            this.showNotification = false;
          }, 3000);
        } catch (err) {
          console.error('Erreur modification :', err);
          this.showError(err.message || 'Erreur lors de la modification');
        }
      }
    },

    async supprimer(id) {
      if (confirm("Êtes-vous sûr de vouloir supprimer ce visiteur ?")) {
        try {
          const res = await fetch('http://localhost/VueJS/visiteurs_app/backend/delete.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id })
          });
          
          const data = await res.json();
          if (!data.success) throw new Error(data.message || 'Erreur serveur');

          this.visiteurs = this.visiteurs.filter(v => v.id !== id);
          this.showNotification = true;
          this.notificationMessage = data.message || 'Suppression réussie';
          this.notificationType = 'success';

          setTimeout(() => this.showNotification = false, 3000);
        } catch (err) {
          console.error('Erreur suppression :', err);
          this.showError(err.message || 'Erreur lors de la suppression');
        }
      }
    }
  }
};
</script>

<style scoped>
.table-responsive {
  overflow-x: auto;
}

.form-control-sm {
  max-width: 100px;
  display: inline-block;
}

.btn {
  margin: 2px 0;
}

.notification {
  animation: slideIn 0.3s forwards, fadeOut 0.3s 2.7s forwards;
}

@keyframes slideIn {
  from { transform: translateY(20px); opacity: 0; }
  to { transform: translateY(0); opacity: 1; }
}

@keyframes fadeOut {
  from { opacity: 1; }
  to { opacity: 0; }
}
</style>