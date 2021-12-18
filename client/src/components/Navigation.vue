<template>
  <div class="flex items-center p-3 bg-red-200">
    <div @click="goToList()" class="cursor-pointer">
      <span class="text-white"> Hot </span>
      <span class="text-red-900 font-bold"> Slice </span>
    </div>
    <div class="ml-auto">
      <button @click="createPizza()" class="p-2 text-red-900">
        Crea Pizza
      </button>
    </div>
  </div>
</template>
<script>
export default {
  name: "Navigation",
  methods: {
    createPizza() {
      this.$router.push({
        name: "create_pizza",
      });
    },
    goToList() {
      this.$router.push({
        name: "list_pizzas",
      });
    },
  },
};
</script>
