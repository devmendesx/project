import Vue from "vue";
import App from "./App.vue";
import router from "./router/index";
import store from "./store";
import vuetify from "./plugins/vuetify";
import "@babel/polyfill";
import VueRouter from "vue-router";
import axios from "axios";
import VCurrencyField from "v-currency-field";

Vue.use(VCurrencyField, {
  locale: "pt-BR",
  decimalLength: 2,
  autoDecimalMode: true,
  prefix: 'R$',
  min: null,
  max: null,
  defaultValue: 0.00,
  valueAsInteger: false,
  allowNegative: false,
});
Vue.use(VueRouter)

window.axios = axios; 

axios.defaults.baseURL = "https://api.raisbbs.com.br";


new Vue({
  router,
  store,
  vuetify,
  render: (h) => h(App),
}).$mount("#app");
