<template>
  <div class="message-container">
    <p id="message-word">{{ msg }}</p>
  </div>
</template>

<script>

export default {
  name: "Message",

  props: {
    msg: String
  }
}

</script>

<style scoped>
.message-container {
  color: #004085;
  background-color: #cce5ff;
  border: 2px solid #b8daff;
  border-radius: 5px;
  padding: 10px 10px 10px 10px;
  max-width: 300px;
  margin: 30px auto;
}

#message-word {
  margin: 10px 10px 10px 15px;
  padding: 10px;
  display: flex !important;
}
</style>