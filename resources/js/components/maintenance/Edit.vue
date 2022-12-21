<template>
  <div>
    <Message :msg="msg" v-show="msg" />
    <div>
      <form id="edit-maintenance" @submit="onSubmit">
        <div class="input-container">
          <label for="text">Descrição:</label>
          <input type="text" name="description" id="description" v-model="description"
            placeholder="Digite o motivo da manutenção:">
        </div>
        <div class="input-container">
          <label for="title">Razão:</label>
          <input type="text" name="reason" id="reason" v-model="reason" placeholder="Digite a razão da manutenção:">
        </div>
        <div class="input-container">
          <label for="date">Data da manutenção:</label>
          <input type="date" name="deadline" id="deadline" v-model="deadline"
            placeholder="Digite a data que ocorrerá a manutenção">
        </div>
        <div class="input-container">
          <label for="select1">Selecione um carro:</label>
          <select id="select1" class="form-select" name="lala" aria-label="Default select example" v-model="car_id">
            <option v-for="car in cars" :key="car.id" :value="car.id">{{ car.model }}</option>
          </select>
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
      description: null,
      reason: null,
      deadline: null,
      msg: null,
      cars: [],
      car_id: null,
    }
  },

  props: ['maintenanceId', "userId"],
  mounted() {
    this.getMaintenance()
    this.getCarsByUser()
  },
  methods: {
    getMaintenance() {
      axios.get(`http://127.0.0.1:8000/api/maintenances/${this.maintenanceId}`).then((result) => {
        this.description = result.data.description;
        this.reason = result.data.reason;
        this.deadline = result.data.deadline.substring(0, 10);
        this.car_id = result.data.id_vehicle;
      })
    },
    onSubmit(e) {
      e.preventDefault()
      axios.put(`http://127.0.0.1:8000/api/maintenances/${this.maintenanceId}`, {
        description: this.description,
        reason: this.reason,
        deadline: this.deadline,
        id_vehicle: this.car_id,
      })
      this.msg = "Informações atualizadas!"
    },
    getCarsByUser() {
      axios.get(`http://127.0.0.1:8000/api/cars/user/${this.userId}`).then((result) => {
        this.cars = result.data
      })
    }
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
</style>
