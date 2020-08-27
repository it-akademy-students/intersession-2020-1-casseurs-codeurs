<template>
  <v-app>
    <nav-menu />
    <v-main
      transition="slide-x-transition"
      class="colorPrimaryLight mostlyWhite--text font-weight-regular"
      style="font-family: 'Lato', sans-serif;"
    >
      <router-view></router-view>

      <!-- banner donate for mobile and tab-port -->
      <donate-banner />
    </v-main>

    <scroll-top-btn />
    
    <footer-app />
  </v-app>
</template>

<script>
import NavMenu from "@/js/components/NavMenu";
import FooterApp from "@/js/layouts/Footer";
import DonateBanner from "@/js/components/DonateBanner";
import ScrollTopBtn from "@/js/components/ScrollTopBtn";

export default {
  name: "App",
  components: {
    NavMenu,
    FooterApp,
    DonateBanner,
    ScrollTopBtn,
  },
  created() {
    this.$vuetify.theme.dark = true;
  },
};
</script>

