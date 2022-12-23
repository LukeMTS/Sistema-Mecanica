<template>
  <div class="container">
    <a class="btn btn-outline-primary" href="/register/maintenance">Adicionar Manutenção Nova</a>
    <h1>Gerenciar Manutenções</h1>
    <div v-if="maintenances.length > 0">
      <div class="table-responsive">
        <table class="table align-middle table table-hover">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th>Descrição</th>
              <th>Data da manutenção</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="maintenance in maintenances" :key="maintenance.id">
              <th>{{ maintenance.id }}</th>
              <td>{{ maintenance.description }}</td>
              <td>{{ formatDate(maintenance.deadline.substring(0, 10)) }}</td>
              <td class="d-flex">
                <select name="status" class="status">
                  <option value="">Selecione</option>
                  <option v-for="s in status" :key="s.id" value="s.status" :selected="maintenance.status_id == s.id">
                    {{ s.status }}
                  </option>
                </select>
                <button class="btn btn-danger" @click="deleteMaintenance(maintenance.id)">Excluir</button>
                <a class="btn btn-primary mx-2" href="`/edit/maintenance/${maintenance.id}`">Editar</a>
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
      status: [],
    }
  },
  mounted() {
    this.getMaintenance();
    this.getStatus();
  },
  methods: {
    getMaintenance() {
      axios.get(`http://127.0.0.1:8000/api/maintenances/users/${this.userId}`).then(({ data }) => {
        this.maintenances = data.data;
        console.log(this.maintenances)
      })
    },
    deleteMaintenance(id) {
      axios.delete(`http://127.0.0.1:8000/api/maintenances/${id}`).then(({ data }) => {
        this.maintenances = this.maintenances.filter(function (item) {
          return item.id !== id;
        });
      })
    },
    getStatus() {
      axios.get('http://127.0.0.1:8000/api/status').then(({ data }) => {
        this.status = data.data;
      })
    },
    formatDate(date) {
      return `${date.substring(8)}/${date.substring(5, 7)}/${date.substring(0, 4)}`;
    }
  }
}
</script>

<style scoped>
select {
  padding: 12px 6px;
  margin-right: 12px;
}
</style>

