<template>

  <div class="container">
    <div class="row">
      <div class="col-12">
        <div v-if="maintenances.length > 0">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-dark rounded-2 bg-gradient shadow pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Manutenções dos Próximos 7 Dias</h6>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Carro</th>
                      <th>Placa</th>
                      <th>Versão</th>
                      <th>Descrição</th>
                      <th class="text-center">Previsão</th>
                      <th class="text-center">Dias Restantes</th>
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
          </div>
        </div>
        <div v-else>
          <h1>Não há Manutenções Previstas Para os Próximos 7 Dias </h1>
          <a href="/maintenance">Ir para a página de manutenções</a>
        </div>
      </div>
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
      axios.get(`http://127.0.0.1:8000/api/home/next-maintenances`).then(({ data }) => {
        this.maintenances = data.data
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