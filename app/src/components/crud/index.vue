<template>
  <div>
    <h1>Pagina de Produtos</h1>
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
        prefix="R$"
        required
        v-model="item.price"
      />
      <v-btn class="mr-4" @click="save"> Cadastrar </v-btn>
    </v-form>
    <br />
    <h2>Listagem de produtos</h2>
    <br />
    <hr />
    <br />
    <v-simple-table dark>
      <template v-slot:default>
        <thead>
          <tr>
            <th class="text-left">Nome</th>
            <th class="text-left">Descrição</th>
            <th class="text-left">Preço</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in listItems" :key="item.name">
            <td>{{ item.name }}</td>
            <td>{{ item.description }}</td>
            <td>{{ item.price }}</td>
          </tr>
        </tbody>
      </template>
    </v-simple-table>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      nameRules: [
        (v) => !!v || "Nome é obrigatório",
      ],
      item: {
        name: "",
        description: "",
        price: "",
      },
      listItems: {},
    };
  },
  methods: {
    save() {
      if (this.$refs.form.validate()) {
        let config = {
          method: "post",
          url: "/api/products",
          data: this.item,
        };

        axios(config)
          .then((response) => alert(response.data.message))
          .catch((error) => alert(error.data.message));
      }
      this.getItems();
    },
    getItems() {
      let config = {
        method: "get",
        url: "/api/products",
      };
      axios(config)
        .then((response) => {
          this.listItems = response.data.data;
        })
        .catch((error) => alert(error.message));
    },
  },
  created() {
    this.getItems();
  },
};
</script>
<style scoped>
</style>
