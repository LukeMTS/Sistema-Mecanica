<template>
  <div class="container">
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>Carro</th>
            <th>Placa</th>
            <th>Versão</th>
            <th>Descrição</th>
            <th class="text-center">Previsão de Manutenção</th>
            <th class="text-center">Dias Restantes Para Manutenção</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="maintenance in maintenances" :key="maintenance.id">
            <td>
              {{ maintenance.vehicle.model }}
              ({{ maintenance.vehicle.brand }})
            </td>
            <td>{{ maintenance.vehicle.license_plate }}</td>
            <td>{{ maintenance.vehicle.version }}</td>

            <td>{{ maintenance.description }}</td>
            <td class="text-center">{{ formatDate(maintenance.deadline.substring(0, 10)) }}</td>
            <td class="text-center">{{ maintenance.days }}</td>

          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      maintenances: [],
    }
  },
  mounted() {
    this.getInfoMaintenances();
  },
  methods: {
    getInfoMaintenances() {
      axios.get(`http://127.0.0.1:8000/api/home/next-maintenances`).then((result) => {
        this.maintenances = result.data
      })
    },
    formatDate(date) {
      return `${date.substring(8)}/${date.substring(5, 7)}/${date.substring(0, 4)}`;
    }
  }
}

</script>

<style scoped>

</style>