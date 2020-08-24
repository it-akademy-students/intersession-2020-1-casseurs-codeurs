<template>
  <v-app>
    <nav-menu />
    <v-main transition="slide-x-transition" class="colorPrimaryLight mostlyWhite--text font-weight-regular" style="font-family: 'Lato', sans-serif;">
      <router-view></router-view>

      <!-- banner donate for mobile and tab-port -->
      <donate-banner />
      
    </v-main>

    <footer-app />
    <!-- <test-example /> -->
  </v-app>
</template>

<script>
import NavMenu from "@/js/components/NavMenu"
import FooterApp from "@/js/layouts/Footer"
import DonateBanner from "@/js/components/DonateBanner"
import TestExample from "@/js/components/TestExample"

export default {
  name: "App",
  components: {
    NavMenu,
    FooterApp,
    DonateBanner,
    TestExample,
  },
  created() {
    this.$vuetify.theme.dark = true;
  },
};
</script>

