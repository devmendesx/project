import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    name: "about",
    component: () => import("@/components/crud/index.vue"),
    meta: {
      title: "About",
    },
  },
  {
    path: "/edit/:id",
    name: "edit",
    component: () => import("@/components/crud/edit.vue"),
  },
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes,
});

export default router;
