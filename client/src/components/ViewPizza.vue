<template>
  <div class="w-full max-w-screen-md mx-auto py-8 px-3">
    <div class="flex items-end">
      <h1 class="font-bold text-3xl">{{ pizza.name }}</h1>
      <h2 class="ml-auto text-green-600 font-bold text-2xl">
        {{ pizza.price }} €
      </h2>
    </div>
    <div class="flex mt-5 items-stretch">
      <div class="h-56 w-56 w-full bg-white cursor-pointer mr-8">
        <img class="w-full h-full" :src="pizza.photo" alt="" />
      </div>
      <div class="flex flex-col justify-between flex-grow">
        <div
          v-for="field in fields"
          :key="field.code"
          class="border-b border-gray-600 flex items-center"
        >
          <span>
            {{ field.label }}
          </span>
          <span class="ml-auto font-bold">
            {{ pizza[field.code] }}
          </span>
        </div>
      </div>
    </div>
    <div>
      <button
        @click="goToList()"
        class="text-gray-500 text-sm cursor-pointer mt-5"
      >
        Torna indietro
      </button>
    </div>
  </div>
</template>
<script>
import axios from "axios";

export default {
  name: "ViewPizza",
  data() {
    return {
      pizza: {},
      fields: [
        {
          label: "Impasto",
          code: "dough",
          type: "select",
          options: [
            {
              label: "Tradizionale",
              code: "traditional",
            },
            {
              label: "Farina di Kamut",
              code: "kamut",
            },
            {
              label: "Alga spirulina",
              code: "spirulina",
            },
            {
              label: "Senza glutine",
              code: "gluten_free",
            },
          ],
        },
        {
          label: "Allergeni",
          code: "allergens",
          type: "text",
        },
        {
          label: "Descrizione",
          code: "description",
          type: "textarea",
        },
      ],
    };
  },
  async mounted() {
    let pizzaId = this.$route.params.id;

    let response = await axios.get(
      "http://localhost:8000/api/pizzas/" + pizzaId
    );
    console.log(response);
    this.pizza = response.data;
  },
  methods: {
    goToList() {
      this.$router.push("/");
    },
  },
};
</script>
