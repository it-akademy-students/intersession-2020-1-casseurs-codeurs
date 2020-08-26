<template>
  <v-card flat color="colorPrimaryUltraLight">
    <v-snackbar v-model="snackbar" absolute top right color="colorSecondaryLight">
      <span color="colorPrimary">Félicitations! Vous êtes bien connecté !</span>
      <v-icon dark>mdi-checkbox-marked-circle</v-icon>
    </v-snackbar>
    <v-col cols="12">
      <h2
        class="pa-4 text-center"
      >Veuillez entrer votre identifiant et votre mot de passe pour vous connecter.</h2>
    </v-col>
    <v-form ref="form" @submit.prevent="submit">
      <v-container fluid>
        <v-row>
          <v-col cols="12">
            <v-text-field
              v-model="form.email"
              :rules="rules.email"
              color="colorTertiaryLight"
              label="Email"
              required
            ></v-text-field>
          </v-col>
          <v-col cols="12">
            <v-text-field
              v-model="form.password"
              :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
              :rules="rules.password"
              :type="show1 ? 'text' : 'password'"
              name="input-10-1"
              label="Mot de passe"
              hint="Minimum 8 characters"
              color="colorTertiaryLight"
              @click:append="show1 = !show1"
            ></v-text-field>
          </v-col>
        </v-row>
      </v-container>
      <v-card-actions>
        <v-btn text @click="resetForm" class="colorTertiaryLight--text">Mot de passe oublié ?</v-btn>
        <v-spacer></v-spacer>
        <v-btn
          :disabled="!formIsValid"
          text
          class="colorTertiaryLight--text"
          type="submit"
        >Me connecter</v-btn>
      </v-card-actions>
    </v-form>
  </v-card>
</template>

<script>
export default {
  name: "LoginForm",
  data() {
    const defaultForm = Object.freeze({
      email: "",
      password: "",
    });

    return {
      show1: false,
      form: Object.assign({}, defaultForm),
      rules: {
        password: [
          (val) => (val || "").length > 0 || "Ce champ est obligatoire",
        ],
        email: [(val) => (val || "").length > 0 || "Ce champ est obligatoire"],
      },
      snackbar: false,
      defaultForm,
    };
  },

  computed: {
    formIsValid() {
      return this.form.email && this.form.password;
    },
  },

  methods: {
    resetForm() {
      this.form = Object.assign({}, this.defaultForm);
      this.$refs.form.reset();
    },
    submit() {
      this.snackbar = true;
      this.resetForm();
    },
  },
};
</script>
