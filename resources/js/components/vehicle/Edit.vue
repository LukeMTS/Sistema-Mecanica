<template>
  <div>
    <Message :msg="msg" :error="error" v-show="msg" />
    <div>
      <div v-if="loading" class="d-flex justify-content-center">
        <div class="big spinner-border text-info" role="status">
        </div>
      </div>
      <form v-else id="edit-car" @submit="onSubmit">
        <div class="input-container">
          <label for="title">Modelo:</label>
          <input type="text" name="model" id="model" v-model="model" required
            placeholder="Digite o modelo do seu carro:">
        </div>
        <div class="input-container">
          <label for="title">Marca:</label>
          <input type="text" name="brand" id="brand" v-model="brand" required
            placeholder="Digite a marca do seu carro:">
        </div>
        <div class="input-container">
          <label for="title">Placa:</label>
          <input type="text" name="license_plate" id="license_plate" required v-model="license_plate"
            placeholder="Digite a placa do seu carro:">
        </div>
        <div class="input-container">
          <label for="nome">Versão:</label>
          <input type="text" name="version" id="version" v-model="version" required
            placeholder="Digite a versão do seu carro:">
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
      model: null,
      brand: null,
      license_plate: null,
      version: null,
      error: false,
      msg: null,
    }
  },
  props: ['carId'],
  mounted() {
    this.getCar()
  },
  methods: {
    getCar() {
      this.loading = true;

      axios.get(`${this.api_url}/cars/${this.carId}`).then(({ data }) => {
        this.model = data.data.model;
        this.brand = data.data.brand;
        this.license_plate = data.data.license_plate;
        this.version = data.data.version;
      }).finally(() => this.loading = false)
    },
    onSubmit(e) {
      e.preventDefault();
      this.loadingUpdate = true;

      axios.put(`${this.api_url}/cars/${this.carId}`, {
        model: this.model,
        brand: this.brand,
        license_plate: this.license_plate,
        version: this.version
      })
        .then(() => {
          window.location.href = '/vehicles'
        })
        .catch(({ response }) => {
          this.msg = response.data.message;
          this.error = true;
        })
        .finally(() => this.loadingUpdate = false)
    }
  },
  components: {
    Message,
  }
}
</script>

<style scoped>
#edit-car {
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
