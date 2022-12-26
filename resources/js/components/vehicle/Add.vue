<template>
  <div>
    <Message :msg="msg" :error="error" v-show="msg" />
    <div>
      <form id="register-car" @submit="onSubmit">
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
          <input type="text" name="license_plate" id="license_plate" v-model="license_plate" required
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
            Registrar meu carro
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
      loadingUpdate: false,
      model: null,
      brand: null,
      license_plate: null,
      version: null,
      msg: null,
      error: false,
    }
  },
  methods: {
    onSubmit(e) {
      e.preventDefault();
      this.loadingUpdate = true;

      axios.post(`${this.api_url}/cars`, {
        model: this.model,
        brand: this.brand,
        license_plate: this.license_plate,
        version: this.version,
      }).then(() => window.location.href = '/vehicles')
        .catch(({ response }) => {
          this.msg = response.data.message;
          this.error = true;
        })
        .finally(() => this.loadingUpdate = false)
    }
  },
  mounted() {
    // alert('Component mounted.')
  },
  components: {
    Message,
  }
}
</script>

<style scoped>
#register-car {
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
</style>
