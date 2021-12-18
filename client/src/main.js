import Vue from 'vue'
import App from './App.vue'

import ListPizzas from '@/components/ListPizzas.vue';
import CreatePizza from '@/components/CreatePizza.vue';

import VueRouter from 'vue-router';

Vue.use(VueRouter);

const routes = [
  {
    path: '/',
    name: 'list_pizzas',
    component: ListPizzas
  },
  {
    path: '/create',
    name: 'create_pizza',
    component: CreatePizza
  },
  {
    path: '/edit/:id',
    name: 'edit_pizza',
    component: CreatePizza
  },
  {
    path: '',
    redirect: '/',
  }
];

const router = new VueRouter({
  mode: "history",
  routes,
});

new Vue({
  router,
  render: h => h(App),
}).$mount('#app')
