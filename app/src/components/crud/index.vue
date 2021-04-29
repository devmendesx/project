<template>
  <div>
    <v-container>
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
        required
        v-model="item.price"
      />
      <v-btn class="mr-4" @click="save" color="#00ff00"> Cadastrar </v-btn>
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
            <td><v-btn :to="'/edit/' + item.id">Editar</v-btn></td>
            <td><v-btn @click="destroy(item.id)">Deletar</v-btn></td>
          </tr>
        </tbody>
      </template>
    </v-simple-table>
    </v-container>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      nameRules: [(v) => !!v || "Nome é obrigatório"],
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
          .then((response) => {
            this.getItems();
            alert(response.data.message);
          })
          .catch((error) => console.log(error.data.message));
      }
    },
    destroy(id){
      if(confirm("Deseja mesmo deletar?")){
       let config = {
          method: "delete",
          url: "/api/products/" + id,
          data: this.item,
        };

        axios(config)
          .then((response) => {
            this.getItems();
            alert(response.data.message);
          })
          .catch((error) => console.log(error.data.message));
      }
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
