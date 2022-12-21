<template>
  <div class="container">
    <a class="btn btn-outline-primary" href="/register/maintenance">Adicionar Manutenção Nova</a>
    <table class="table">
      <thead>
        <tr>
          <th>Descrição</th>
          <th>Razão</th>
          <th>Data da manutenção</th>
          <th class="text-center">Ações</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="maintenance in maintenances" :key="maintenance.id">
          <td>{{ maintenance.description }}</td>
          <td>{{ maintenance.reason }}</td>
          <td>{{ maintenance.deadline }}</td>
          <td class="text-center">
            <button class="btn btn-danger" @click="deleteMaintenance(maintenance.id)">Excluir Manutenção</button>
            <a class="btn btn-primary mx-2" :href="`/edit/maintenance/${maintenance.id}`">Editar Manutenção</a>
          </td>
        </tr>
      </tbody>
    </table>

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
    this.getMaintenance();
  },
  methods: {
    getMaintenance() {
      axios.get('http://127.0.0.1:8000/api/maintenances').then((result) => {
        this.maintenances = result.data;
      })
    },
    deleteMaintenance(id) {
      axios.delete(`http://127.0.0.1:8000/api/maintenances/${id}`).then((result) => {
        this.maintenances = this.maintenances.filter(function (item) {
          return item.id !== id;
        });
      })
    }
  }
}
</script>


