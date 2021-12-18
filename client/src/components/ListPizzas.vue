<template>
  <div class="w-full max-w-screen-md mx-auto pt-8">
    <div class="grid grid-cols-3 gap-x-5">
      <div
        class="bg-gray-200 rounded flex flex-col p-3"
        v-for="pizza in pizzas"
        :key="pizza.id"
      >
        <div class="h-32 w-full bg-white">
          <img class="w-full h-full" :src="pizza.photo" alt="" />
        </div>
        <div class="flex flex-row items-center pt-3">
          <div class="flex-grow">
            {{ pizza.name }}
          </div>
          <div class="flex">
            <h2 class="ml-auto text-green-600 font-bold text-xl">
              {{ pizza.price }} €
            </h2>
          </div>
        </div>
        <div class="mt-3 ml-auto space-x-3">
          <button
            class="text-yellow-600 text-sm font-bold"
            @click="edit(pizza)"
          >
            Modifica
          </button>
          <button
            class="text-red-600 text-sm font-bold"
            @click="deletePizza(pizza)"
          >
            Elimina
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";

export default {
  name: "ListPizzas",
  data() {
    return {
      pizzas: [],
    };
  },
  async mounted() {
    let response = await axios.get("http://localhost:8000/api/pizzas");
    this.pizzas = response.data;
  },
  methods: {
    edit(pizza) {
      this.$router.push("/edit/" + pizza.id);
    },
  },
};
</script>
