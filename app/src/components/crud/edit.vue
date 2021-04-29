<template>
  <div>
    <h1>Edição de Produto</h1>
    <br />
    <v-form ref="form">
      <v-text-field
        v-model="item.name"
        label="Nome"
        :rules="nameRules"
        required
      >
      </v-text-field>
      <v-textarea
        v-model="item.description"
        label="Descrição"
        :rules="nameRules"
        required
        rows="2"
      />

      <v-currency-field
        label="Preço"
        required
        v-model="item.price"
      />
      <v-btn class="mr-4" @click="update" color="#00ff00"> Atualizar </v-btn>
    </v-form>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      nameRules: [(v) => !!v || "Nome é obrigatório"],
      descriptionRules: [(v) => !!v || "Descrição é obrigatório"],
      item: {
        name: "",
        description: "",
        price: "",
      },
    };
  },
  methods: {
    update() {
      if (this.$refs.form.validate()) {
        let config = {
          method: "put",
          url: "/api/products/" + this.$route.params.id,
          data: this.item,
        };

        axios(config)
          .then((response) => {
            alert(response.data.message);   
            this.$router.push({ path: '/' })
          })
          .catch((error) => console.log(error.data.message));
      }
    },
  },
  beforeCreate() {
    let config = {
      method: "get",
      url: "/api/products/" + this.$route.params.id,
    };
    axios(config)
      .then((response) => {
        this.item = response.data;
      })
      .catch((error) => alert(error.message));
  },
};
</script>
<style scoped>
</style>
