<template>
  <div>
    <Message :msg="msg" :error="error" v-show="msg" />
    <div>
      <div v-if="loading" class="d-flex justify-content-center">
        <div class="big spinner-border text-info" role="status">
        </div>
      </div>
      <form v-else id="register-maintenance" @submit="onSubmit">
        <div class="input-container">
          <label for="text">Descrição:</label>
          <input type="text" name="description" id="description" v-model="description"
            placeholder="Digite o motivo da manutenção:">
        </div>
        <div class="input-container">
          <label for="date">Data da manutenção:</label>
          <input type="date" name="deadline" id="deadline" required v-model="deadline" :min="todayDate"
            placeholder="Digite a data que ocorrerá a manutenção">
        </div>
        <div class="input-container">
          <label for="select1">Selecione um carro:</label>
          <select id="select1" class="form-select" aria-label="Default select example" v-model="car_id">
            <option v-for="car in cars" :key="car.id" :value="car.id">{{ car.model }}</option>
          </select>
        </div>

        <div class="input-container">
          <button type="submit" :disabled="loadingUpdate" class="submit-btn w-100">
            <span v-if="loadingUpdate" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Cadastrar Manutenção
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import Message from "../Message.vue"

export default {
  data() {
    return {
      api_url: import.meta.env.VITE_APP_API_URL,
      loading: true,
      loadingUpdate: false,
      description: null,
      reason: null,
      deadline: null,
      car_id: null,
      msg: null,
      error: false,
      cars: [],
    }
  },
  computed: {
    todayDate() {
      const date = new Date();

      const year = date.toLocaleString("default", { year: "numeric" });
      const month = date.toLocaleString("default", { month: "2-digit" });
      const day = date.toLocaleString("default", { day: "2-digit" });

      return year + "-" + month + "-" + day;
    }
  },
  methods: {
    onSubmit(e) {
      e.preventDefault();
      this.loadingUpdate = true;

      axios.post(`${this.api_url}/maintenances`, {
        description: this.description,
        reason: this.reason,
        deadline: this.deadline,
        id_vehicle: this.car_id,
      }).then(() => window.location.href = '/maintenances')
        .catch(({ response }) => {
          this.msg = response.data.message;
          this.error = true;
        })
        .finally(() => this.loadingUpdate = false)
    },
    getCarsByUser() {
      this.loading = true;

      axios.get(`${this.api_url}/cars`).then(({ data }) => {
        this.cars = data.data
      }).finally(() => this.loading = false)
    },
  },
  mounted() {
    this.getCarsByUser()
  },
  components: {
    Message,
  }
}
</script>

<style scoped>
#register-maintenance {
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
