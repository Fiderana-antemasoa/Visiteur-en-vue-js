<template>
  <div class="container mx-auto p-4 max-w-3xl">
    <div class="bg-white rounded-lg shadow-md p-6">
      <h2 class="text-2xl font-bold text-gray-800 mb-4 border-b pb-2">Bilan des Visiteurs</h2>
      
      <div class="grid grid-cols-3 gap-4 mb-6">
        <div class="bg-blue-50 p-4 rounded-lg">
          <p class="text-sm text-blue-600 font-medium">Total</p>
          <p class="text-xl font-bold">{{ bilan.total }} Ariary</p>
        </div>
        
        <div class="bg-green-50 p-4 rounded-lg">
          <p class="text-sm text-green-600 font-medium">Minimum</p>
          <p class="text-xl font-bold">{{ bilan.min }} Ariary</p>
        </div>
        
        <div class="bg-red-50 p-4 rounded-lg">
          <p class="text-sm text-red-600 font-medium">Maximum</p>
          <p class="text-xl font-bold">{{ bilan.max }} Ariary</p>
        </div>
      </div>

      <div class="bg-gray-50 p-4 rounded-lg">
        <canvas ref="graph" class="w-full h-64"></canvas>
      </div>
    </div>
  </div>
</template>

<script>
import Chart from 'chart.js/auto'

export default {
  data() {
    return { bilan: { total: 0, min: 0, max: 0 }, chart: null }
  },
  async mounted() {
    const res = await fetch('http://localhost/VueJS/visiteurs_app/backend/bilan.php')
    this.bilan = await res.json()

    this.chart = new Chart(this.$refs.graph, {
      type: 'bar',
      data: {
        labels: ['Total', 'Min', 'Max'],
        datasets: [{
          label: 'Tarif des visiteurs',
          data: [this.bilan.total, this.bilan.min, this.bilan.max],
          backgroundColor: ['blue', 'green', 'red']
        }]
      }
    })
  }
}
</script>

<style scoped>
.container {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
</style>  