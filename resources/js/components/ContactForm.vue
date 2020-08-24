<template>
  <v-row justify="center">
    <!-- <v-dialog v-model="dialog" persistent max-width="600px"> -->
    <!-- <template v-slot:activator="{ on, attrs }">
        <v-btn color="primary" dark v-bind="attrs" v-on="on">Open Dialog</v-btn>
    </template>-->

    <v-card color="colorPrimaryUltraLight" class="pa-3">
      <!-- <v-card-title>
          <span
            class="headline text-center colorSecondary--text"
          >Une question ? Contactez Nous ! Nous serons ravie de vous répondre au plus vite !</span>
      </v-card-title>-->
      <v-card-text>
        <v-container>
          <v-row>
            <v-col cols="12">
              <v-text-field label="Nom*" required color="secondary"></v-text-field>
            </v-col>
            <v-col cols="12">
              <v-text-field label="Prénom" color="secondary"></v-text-field>
            </v-col>
            <v-col cols="12">
              <v-text-field label="Email*" required color="secondary"></v-text-field>
            </v-col>
            <v-col cols="12">
              <v-textarea color="secondary" label="Message*"></v-textarea>
            </v-col>
          </v-row>
        </v-container>
        <small>*Champs obligatoires</small>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="warning" text @click="dialog = false" href="/">Close</v-btn>
        <v-btn color="success" text @click="dialog = false " href="/">Save</v-btn>
      </v-card-actions>
    </v-card>
    <!-- </v-dialog> -->
  </v-row>
</template>

<script>
export default {
  name: "ContactForm",
  data: () => ({
    dialog: true,
  }),
};
</script>