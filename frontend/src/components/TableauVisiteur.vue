<template>
  <table border="1">
    <thead>
      <tr>
        <th>Nom</th>
        <th>Nb jours</th>
        <th>Tarif jour</th>
        <th>Tarif</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="v in visiteurs" :key="v.id">
        <td><input v-model="v.nom" /></td>
        <td><input type="number" v-model.number="v.nb_jours" /></td>
        <td><input type="number" v-model.number="v.tarif_journalier" /></td>
        <td>{{ v.nb_jours * v.tarif_journalier }}</td>
        <td>
          <button @click="$emit('modifier', v)">Modifier</button>
          <button @click="$emit('supprimer', v.id)">Supprimer</button>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script>
export default {
  props: {
    visiteurs: Array
  },
  emits: ['modifier', 'supprimer']
}
</script>
