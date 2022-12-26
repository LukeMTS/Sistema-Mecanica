<template>
  <div class="container mt-5">
    <Message :msg="msg" v-show="msg" />

    <div class="d-flex justify-content-between">
      <h2>Gerenciar manutenções</h2>
      <a class="btn btn-outline-primary mb-5" href="/register/maintenance">Adicionar Manutenção</a>
    </div>
    <div v-if="loading" class="d-flex justify-content-center">
      <div class="big spinner-border text-info" role="status">
      </div>
    </div>
    <div v-else>
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
                  <select :disabled="loadingUpdate" name="status" class="custom-select" v-model="maintenance.status_id"
                    @change="changeStatus(maintenance.id, maintenance.status_id)">
                    <option value="">Selecione</option>
                    <option v-for="s in status" :key="s.id" :value="s.id">
                      {{ s.status }}
                    </option>
                  </select>
                  <button class="btn btn-danger" :disabled="loadingDelete" @click="deleteMaintenance(maintenance.id)">
                    Excluir
                  </button>
                  <div class="btn btn-primary mx-2">
                    <a class="btn btn-primary" :href="`/edit/maintenance/${maintenance.id}`">
                      Editar
                    </a>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="text-center mt-4" v-else>
        <h4>Não há manutenções cadastradas.</h4>
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
      loadingUpdate: false,
      maintenances: [],
      status: [],
      msg: null,
    }
  },
  mounted() {
    this.loading = true;
    this.msg = this.message;

    this.getMaintenance();
    this.getStatus();
  },
  components: {
    Message,
  },
  methods: {
    getMaintenance() {
      axios.get(`${this.api_url}/maintenances`).then(({ data }) => {
        this.maintenances = data.data;
      })
    },
    deleteMaintenance(id) {
      this.loadingDelete = true;

      axios.delete(`${this.api_url}/maintenances/${id}`).then(({ data }) => {
        this.maintenances = this.maintenances.filter(function (item) {
          return item.id !== id;
        });
      }).finally(() => this.loadingDelete = false)
    },
    getStatus() {
      axios.get(`${this.api_url}/status`).then(({ data }) => {
        this.status = data.data;
      }).finally(() => this.loading = false)
    },
    changeStatus(maintenance_id, status_id) {
      this.loadingUpdate = true;

      axios.patch(`${this.api_url}/maintenances/${maintenance_id}`, {
        status_id: status_id
      }).then(() => this.msg = 'Status atualizado com sucesso.')
        .finally(() => this.loadingUpdate = false);

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

.big.spinner-border {
  width: 4rem;
  height: 4rem;
}
</style>

