<template>
  <div>
    <!-- Provides the application the proper gutter -->
    <v-container fluid>
      <!-- vue-router -->
      <router-view></router-view>
      <!-- main/welcome section -->
      <main-app />
    </v-container>
    <!-- result section -->
    <v-container fluid>
      <result-section />
    </v-container>
  </div>
</template>

<script>
import MainApp from "@/js/layouts/MainApp";
import ResultSection from "@/js/layouts/ResultSection";

export default {
  name: "Home",
  components: {
    MainApp,
    ResultSection,
  },
};
</script>

