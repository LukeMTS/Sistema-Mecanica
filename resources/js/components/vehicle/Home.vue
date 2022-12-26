<template>
  <div class="container mt-5">
    <Message :msg="msg" v-show="msg" />

    <div class="d-flex justify-content-between">
      <h2>Gerenciar veículos</h2>
      <a class="btn btn-outline-primary mb-5" href="/register/vehicles">Adicionar veículo</a>
    </div>
    <div v-if="loading" class="d-flex justify-content-center">
      <div class="big spinner-border text-info" role="status">
      </div>
    </div>
    <div v-else>
      <div v-if="cars.length > 0">
        <div class="table-responsive">
          <table class="table align-middle table table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th>Modelo</th>
                <th>Marca</th>
                <th>Placa</th>
                <th>Versão</th>
                <th class="text-center">Ações</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="car in cars" :key="car.id">
                <th>{{ car.id }}</th>
                <td>{{ car.model }}</td>
                <td>{{ car.brand }}</td>
                <td>{{ car.license_plate }}</td>
                <td>{{ car.version }}</td>
                <td class="d-flex justify-content-center">
                  <button :disabled="loadingDelete" class="btn btn-danger" @click="deleteCar(car.id)">
                    Excluir
                  </button>
                  <a class="btn btn-primary mx-2" :href="`/edit/vehicle/${car.id}`">Editar</a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="text-center mt-4" v-else>
        <h4>Não há veículos cadastrados.</h4>
      </div>
    </div>

  </div>
</template>

<script>
import Message from "../Message.vue"

export default {
  props: ["message"],
  data() {
    return {
      api_url: import.meta.env.VITE_APP_API_URL,
      loading: true,
      loadingDelete: false,
      cars: [],
      msg: null,
    }
  },
  mounted() {
    this.msg = this.message;

    this.getVehicules();
  },
  components: {
    Message,
  },
  methods: {
    getVehicules() {
      this.loading = true;

      axios.get(`${this.api_url}/cars`).then(({ data }) => {
        this.cars = data.data;
      }).finally(() => this.loading = false)
    },
    deleteCar(id) {
      this.loadingDelete = true;

      axios.delete(`${this.api_url}/cars/${id}`).then(({ data }) => {
        this.cars = this.cars.filter(function (item) {
          return item.id !== id;
        });
      }).finally(() => this.loadingDelete = false)
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

