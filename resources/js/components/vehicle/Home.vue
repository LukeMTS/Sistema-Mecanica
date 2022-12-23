<template>
  <div class="container">
    <a class="btn btn-outline-primary" href="/register/vehicles">Adicionar Carro</a>
    <h1 class="text-center">Gerenciar Veículos:</h1>
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
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="car in cars" :key="car.id">
              <th>{{ car.id }}</th>
              <td>{{ car.model }}</td>
              <td>{{ car.brand }}</td>
              <td>{{ car.license_plate }}</td>
              <td>{{ car.version }}</td>
              <td class="d-flex">
                <button class="btn btn-danger" @click="deleteCar(car.id)">Excluir</button>
                <a class="btn btn-primary mx-2" :href="`/edit/vehicle/${car.id}`">Editar</a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div v-else>
      <h1>Não Há Carros Cadastrados</h1>
    </div>
  </div>
</template>

<script>
export default {
  props: ["userId"],
  data() {
    return {
      cars: [],
    }
  },
  mounted() {
    this.getVehicules();
  },
  methods: {
    getVehicules() {
      axios.get(`http://127.0.0.1:8000/api/cars/users/${this.userId}`).then(({ data }) => {
        this.cars = data.data;
      })
    },
    deleteCar(id) {
      axios.delete(`http://127.0.0.1:8000/api/cars/${id}`).then(({ data }) => {
        this.cars = this.cars.filter(function (item) {
          return item.id !== id;
        });
      })
    }
  }
}
</script>


