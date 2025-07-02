<template>
  <form @submit.prevent="handleSubmit">
    <input 
      v-model="visiteur.nom" 
      @input="validateName"
      @keydown="preventNumberInput"
      placeholder="Nom" 
      required 
    />
    <!-- autres champs... -->
  </form>
</template>

<script>
export default {
  // ... autres code ...
  methods: {
    validateName(event) {
      // Version plus stricte - seulement lettres et espaces
      this.visiteur.nom = event.target.value.replace(/[^a-zA-ZÀ-ÿ\s]/g, '');
    },
    preventNumberInput(event) {
      // Empêche directement la saisie des chiffres
      if (event.key >= '0' && event.key <= '9') {
        event.preventDefault();
      }
    },
    handleSubmit() {
      if (!/^[a-zA-ZÀ-ÿ\s]+$/.test(this.visiteur.nom.trim())) {
        alert("Le nom ne doit contenir que des lettres et espaces");
        return;
      }
      this.$emit('submit', this.visiteur);
    }
  }
}
</script>