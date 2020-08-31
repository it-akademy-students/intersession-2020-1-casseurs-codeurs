<template>
  <v-container fluid>
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

