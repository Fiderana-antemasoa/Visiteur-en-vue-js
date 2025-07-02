<template>
  <canvas ref="graph" width="400" height="200"></canvas>
</template>

<script>
import Chart from 'chart.js/auto'

export default {
  props: ['bilan'],
  mounted() {
    new Chart(this.$refs.graph, {
      type: 'bar', // ou 'pie'
      data: {
        labels: ['Total', 'Min', 'Max'],
        datasets: [{
          label: 'Tarif des visiteurs',
          data: [this.bilan.total, this.bilan.min, this.bilan.max],
          backgroundColor: ['#3498db', '#2ecc71', '#e74c3c']
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: { display: false }
        }
      }
    })
  }
}
</script>
