<template>
  <div>
    <!-- Provides the application the proper gutter -->
    <v-container fluid class="py-0">
      <!-- vue-router -->
      <router-view></router-view>
      <!-- main/welcome section -->
      <main-app />
    </v-container>
  </div>
</template>

<script>
import MainApp from "@/js/layouts/MainApp";

export default {
  name: "Home",
  components: {
    MainApp,
  },
};
</script>

