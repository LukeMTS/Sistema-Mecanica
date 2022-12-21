<template>
  <div>
    <Message :msg="msg" v-show="msg" />
    <div>
      <form id="edit-car" @submit="onSubmit">
        <div class="input-container">
          <label for="title">Modelo:</label>
          <input type="text" name="model" id="model" v-model="model" placeholder="Digite o modelo do seu carro:">
        </div>
        <div class="input-container">
          <label for="title">Marca:</label>
          <input type="text" name="brand" id="brand" v-model="brand" placeholder="Digite a marca do seu carro:">
        </div>
        <div class="input-container">
          <label for="title">Placa:</label>
          <input type="text" name="license_plate" id="license_plate" v-model="license_plate"
            placeholder="Digite a placa do seu carro:">
        </div>
        <div class="input-container">
          <label for="nome">Versão:</label>
          <input type="text" name="version" id="version" v-model="version" placeholder="Digite a versão do seu carro:">
        </div>
        <div class="input-container">
          <input type="submit" class="submit-btn" value="Atualizar informações" />
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
      model: "",
      brand: "",
      license_plate: "",
      version: "",
      msg: "",
    }
  },
  props: ['carId'],
  mounted() {
    this.getCar()
  },
  methods: {
    getCar() {
      axios.get(`http://127.0.0.1:8000/api/cars/${this.carId}`).then((result) => {
        this.model = result.data.model;
        this.brand = result.data.brand;
        this.license_plate = result.data.license_plate;
        this.version = result.data.version;
      })
    },
    onSubmit(e) {
      e.preventDefault()
      axios.put(`http://127.0.0.1:8000/api/cars/${this.carId}`, {
        model: this.model,
        brand: this.brand,
        license_plate: this.license_plate,
        version: this.version

      }).then(() => {
        this.msg = "Informações atualizadas!"
      })
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
</style>
