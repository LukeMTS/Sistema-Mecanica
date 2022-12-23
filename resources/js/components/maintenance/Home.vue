<template>
  <div class="container">
    <a class="btn btn-outline-primary" href="/register/maintenance">Adicionar Manutenção Nova</a>
    <div v-if="maintenances.length > 0">
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>Descrição</th>
              <th>Data da manutenção</th>
              <th class="text-center">Ações</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="maintenance in maintenances" :key="maintenance.id">
              <td>{{ maintenance.description }}</td>
              <td>{{ formatDate(maintenance.deadline.substring(0, 10)) }}</td>
              <td class="text-center justify-content-center d-flex">
                <button class="btn btn-danger" @click="deleteMaintenance(maintenance.id)">Excluir</button>
                <a class="btn btn-primary mx-2" :href="`/edit/maintenance/${maintenance.id}`">Editar Manutenção</a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div v-else>
      <h1>Não há Manutenções Cadastradas</h1>
    </div>
  </div>
</template>

<script>
export default {
  props: ["userId"],
  data() {
    return {
      maintenances: [],
    }
  },
  mounted() {
    this.getMaintenance();
  },
  methods: {
    getMaintenance() {
      axios.get(`http://127.0.0.1:8000/api/maintenances/users/${this.userId}`).then(({ data }) => {
        this.maintenances = data.data;
      })
    },
    deleteMaintenance(id) {
      axios.delete(`http://127.0.0.1:8000/api/maintenances/${id}`).then(({ data }) => {
        this.maintenances = this.maintenances.filter(function (item) {
          return item.id !== id;
        });
      })
    },
    formatDate(date) {
      return `${date.substring(8)}/${date.substring(5, 7)}/${date.substring(0, 4)}`;
    }
  }
}
</script>


