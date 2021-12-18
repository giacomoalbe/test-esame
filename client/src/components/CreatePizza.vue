<template>
  <div class="w-full max-w-screen-md mx-auto py-8 px-3">
    <div class="flex flex-col mb-3" v-for="field in fields" :key="field.code">
      <label class="mb-2 font-bold text-red-900" :for="field.code">{{
        field.label
      }}</label>
      <input
        v-if="field.type == 'text'"
        class="border border-gray-200 p-2 rounded"
        type="text"
        :id="field.code"
        v-model="newPizza[field.code]"
      />
      <input
        v-if="field.type == 'number'"
        class="border border-gray-200 p-2 rounded"
        type="number"
        :id="field.code"
        v-model="newPizza[field.code]"
      />
      <select
        v-if="field.type == 'select'"
        class="border border-gray-200 p-2 rounded bg-white"
        :name="field.code"
        :id="field.code"
        v-model="newPizza[field.code]"
      >
        <option
          v-for="option in field.options"
          :key="option.code"
          :value="option.code"
        >
          {{ option.label }}
        </option>
      </select>
      <textarea
        v-if="field.type == 'textarea'"
        v-model="newPizza[field.code]"
        class="border border-gray-200 p-2 rounded bg-white"
        :id="field.code"
        cols="30"
        rows="10"
      >
      </textarea>
    </div>
    <div class="pt-3">
      <button
        @click="createPizza()"
        :disabled="!formIsValid"
        class="disabled:bg-gray-300 disabled:cursor-not-allowed p-2 px-3 rounded bg-red-800 text-white"
      >
        {{ $route.name == "edit_pizza" ? "Salva" : "Crea" }}
      </button>
    </div>
  </div>
</template>
<script>
import axios from "axios";

export default {
  name: "CreatePizza",
  data() {
    return {
      fields: [
        {
          label: "Nome",
          code: "name",
          type: "text",
        },
        {
          label: "Foto",
          code: "photo",
          type: "text",
        },
        {
          label: "Prezzo",
          code: "price",
          type: "number",
        },
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
      newPizza: {
        name: "",
        photo: "",
        price: 0,
        dough: "traditional",
        allergens: "",
        description: "",
      },
    };
  },
  async mounted() {
    if (this.$route.name == "edit_pizza") {
      let response = await axios.get(
        "http://localhost:8000/api/pizzas/" + this.$route.params.id
      );
      this.newPizza = response.data;
    }
  },
  methods: {
    async createPizza() {
      if (this.$route.name == "edit_pizza") {
        let response = await axios.put(
          "http://localhost:8000/api/pizzas/" + this.$route.params.id,
          this.newPizza
        );

        if (response.status == 200) {
          this.$router.push("/");
        }
      } else {
        let response = await axios.post(
          "http://localhost:8000/api/pizzas",
          this.newPizza
        );

        if (response.status == 201) {
          this.$router.push("/");
        }
      }
    },
  },
  computed: {
    formIsValid() {
      return (
        this.newPizza.name != "" &&
        this.newPizza.photo != "" &&
        this.newPizza.price > 0 &&
        this.newPizza.dough != "" &&
        this.newPizza.allergens != "" &&
        this.newPizza.description != ""
      );
    },
  },
};
</script>
