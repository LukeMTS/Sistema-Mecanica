<template>
  <div>
    <Message :msg="msg" :error="error" v-show="msg" />
    <div>
      <div v-if="loading" class="d-flex justify-content-center">
        <div class="big spinner-border text-info" role="status">
        </div>
      </div>
      <form v-else id="edit-maintenance" @submit="onSubmit">
        <div class="input-container">
          <label for="text">Descrição:</label>
          <input type="text" name="description" id="description" required v-model="description"
            placeholder="Digite o motivo da manutenção:">
        </div>
        <div class="input-container">
          <label for="date">Data da manutenção:</label>
          <input type="date" name="deadline" id="deadline" required v-model="deadline"
            placeholder="Digite a data que ocorrerá a manutenção">
        </div>
        <div class="input-container">
          <label for="select1">Selecione um carro:</label>
          <select id="select1" class="form-select" name="lala" aria-label="Default select example" v-model="car_id">
            <option v-for="car in cars" :key="car.id" :value="car.id">{{ car.model }}</option>
          </select>
        </div>
        <div class="input-container">
          <button type="submit" :disabled="loadingUpdate" class="submit-btn w-100">
            <span v-if="loadingUpdate" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Atualizar informações
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import Message from "../Message.vue"

export default {
  name: 'Edit',
  data() {
    return {
      api_url: import.meta.env.VITE_APP_API_URL,
      loading: true,
      loadingUpdate: false,
      description: null,
      deadline: null,
      msg: null,
      cars: [],
      car_id: null,
      error: false,
    }
  },

  props: ['maintenanceId'],
  mounted() {
    this.loading = true;

    this.getMaintenance()
    this.getCarsByUser()
  },
  methods: {
    getMaintenance() {
      axios.get(`${this.api_url}/maintenances/${this.maintenanceId}`).then(({ data }) => {
        this.description = data.data.description;
        this.deadline = data.data.deadline.substring(0, 10);
        this.car_id = data.data.id_vehicle;
      })
    },
    getCarsByUser() {
      axios.get(`${this.api_url}/cars`).then(({ data }) => {
        this.cars = data.data
      }).finally(() => this.loading = false)
    },
    onSubmit(e) {
      e.preventDefault();
      this.loadingUpdate = true;

      axios.put(`${this.api_url}/maintenances/${this.maintenanceId}`, {
        description: this.description,
        deadline: this.deadline,
        id_vehicle: this.car_id,
      }).then(() => window.location.href = '/maintenances')
        .catch(({ response }) => {
          this.msg = response.data.message;
          this.error = true;
        })
        .finally(() => this.loadingUpdate = false)
    },
  },
  components: {
    Message,
  }
}
</script>

<style scoped>
#edit-maintenance {
  width: 300px;
  margin: 0 auto;
}

.input-container {
  display: flex;
  flex-direction: column;
  margin-bottom: 20px;
  margin-top: 20px;
}

label {
  font-weight: bold;
  margin-bottom: 15px;
  color: #222;
  padding: 5px 10px;
  border-left: 4px solid #222;
}

input,
select {
  padding: 5px 10px;
  width: 300px;
}

.submit-btn {
  background-color: #222;
  color: rgb(255, 255, 255);
  font-weight: bold;
  border: 2px solid #222;
  padding: 10px;
  font-size: 16px;
  margin: 0 auto;
  cursor: pointer;
  transition: .5s;
}

.submit-btn:hover {
  background-color: transparent;
  color: #222;
}

.big.spinner-border {
  width: 4rem;
  height: 4rem;
}
</style>
