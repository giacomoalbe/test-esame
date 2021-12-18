<template>
  <div id="app" class="h-screen flex flex-col">
    <Navigation></Navigation>
    <div class="flex-grow">
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
import Navigation from "@/components/Navigation.vue";

export default {
  name: "App",
  components: {
    Navigation,
  },
};
</script>
