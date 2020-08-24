<template>
  <v-container fluid>
    <v-row justify="center" align="center" class="pa-5 my-5">
      <h2
        class="display-1 text-center"
      >Une question ? Contactez Nous ! Nous serons ravie de vous répondre au plus vite !</h2>
    </v-row>
    <!-- form -->
    <contact-form />
  </v-container>
</template>

<script>
import ContactForm from "@/js/components/ContactForm";

export default {
  name: "Contact",
  components: {
    ContactForm,
  },
};
</script>