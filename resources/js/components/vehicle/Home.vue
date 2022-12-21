<template>
  <div class="container">
    <a class="btn btn-outline-primary" href="/register/vehicles">Adicionar Carro</a>
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>Modelo</th>
            <th>Marca</th>
            <th>Placa</th>
            <th>Versão</th>
            <th class="text-center">Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="car in cars" :key="car.id">
            <td>{{ car.model }}</td>
            <td>{{ car.brand }}</td>
            <td>{{ car.license_plate }}</td>
            <td>{{ car.version }}</td>
            <td class="text-center justify-content-center d-flex">
              <button class="btn btn-danger" @click="deleteCar(car.id)">Excluir</button>
              <a class="btn btn-primary mx-2" :href="`/edit/vehicle/${car.id}`">Editar</a>
            </td>
          </tr>
        </tbody>
      </table>
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
      axios.get(`http://127.0.0.1:8000/api/cars/users/${this.userId}`).then((result) => {
        this.cars = result.data;
      })
    },
    deleteCar(id) {
      axios.delete(`http://127.0.0.1:8000/api/cars/${id}`).then((result) => {
        this.cars = this.cars.filter(function (item) {
          return item.id !== id;
        });
      })
    }
  }
}
</script>


