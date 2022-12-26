<template>

  <div class="container">
    <div class="row">
      <div class="col-12">
        <div v-if="loading" class="d-flex justify-content-center">
          <div class="big spinner-border text-info" role="status">
          </div>
        </div>
        <div v-else>
          <div v-if="maintenances.length > 0">
            <div class="card my-4">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-dark rounded-2 bg-gradient shadow pt-4 pb-3">
                  <h6 class="text-white text-capitalize ps-3">Manutenções dos Próximos 7 Dias</h6>
                </div>
              </div>
              <div class="card-body px-0 pb-2">
                <div class="table-responsive">
                  <table class="table text-center align-middle table table-hover">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th>Carro</th>
                        <th>Placa</th>
                        <th>Versão</th>
                        <th>Descrição</th>
                        <th>Previsão</th>
                        <th>Dias Restantes</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="maintenance in maintenances" :key="maintenance.id">
                        <th>{{ maintenance.id }}</th>
                        <td>
                          {{ maintenance.vehicle.model }}
                          ({{ maintenance.vehicle.brand }})
                        </td>
                        <td>{{ maintenance.vehicle.license_plate }}</td>
                        <td>{{ maintenance.vehicle.version }}</td>

                        <td>{{ maintenance.description }}</td>
                        <td>{{ formatDate(maintenance.deadline.substring(0, 10)) }}</td>
                        <td :class="daysClass(maintenance.days)">{{ maintenance.days }}</td>
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
  </div>

</template>

<script>
export default {
  data() {
    return {
      api_url: import.meta.env.VITE_APP_API_URL,
      loading: true,
      maintenances: [],
    }
  },
  mounted() {
    this.getInfoMaintenances();
  },
  methods: {
    getInfoMaintenances() {
      this.loading = true;

      axios.get(`${this.api_url}/home/next-maintenances`).then(({ data }) => {
        this.maintenances = data.data
      }).finally(() => this.loading = false)
    },
    formatDate(date) {
      return `${date.substring(8)}/${date.substring(5, 7)}/${date.substring(0, 4)}`;
    },
    daysClass(days) {
      if (days >= 4)
        return 'badge bg-primary';
      else if (days >= 2)
        return 'badge bg-warning text-white';

      return 'badge bg-danger';
    }
  }
}

</script>

<style scoped>
.big.spinner-border {
  width: 4rem;
  height: 4rem;
}
</style>