<template>
  <div>
    <!-- Provides the application the proper gutter -->
    <v-container fluid class="py-0">
      <!-- main section -->
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

