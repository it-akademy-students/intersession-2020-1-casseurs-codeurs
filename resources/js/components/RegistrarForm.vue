<template>
  <v-card flat color="colorPrimaryUltraLight">
    <v-snackbar v-model="snackbar" absolute top right color="colorSecondaryLight">
      <span color="colorPrimary">Félicitations! Votre compte est crée !</span>
      <v-icon dark>mdi-checkbox-marked-circle</v-icon>
    </v-snackbar>
    <v-col cols="12">
      <h2
        class="pa-4 text-center"
      >Inscrivez-vous afin de bénéficier de toutes les fonctionnalités de l’application SWAPP</h2>
    </v-col>
    <v-form ref="form" @submit.prevent="submit">
      <v-container fluid>
        <v-row>
          <v-col cols="12">
            <v-text-field
              v-model="form.username"
              :rules="rules.username"
              color="colorTertiaryLight"
              label="Nom d'utilisateur"
              required
            ></v-text-field>
          </v-col>
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
          <v-col cols="12">
            <v-select
              v-model="form.job"
              :items="jobs"
              :rules="rules.job"
              color="colorTertiaryLight"
              label="Votre Job"
              required
            ></v-select>
          </v-col>
          <v-col cols="12">
            <v-checkbox v-model="form.terms" color="colorTertiaryLight">
              <template v-slot:label>
                <div @click.stop>
                  Merci de lire et accepter les
                  <a
                    href="javascript:;"
                    @click.stop="terms = true"
                    class="btn-text btn-text--violet"
                  >terms</a>
                  et
                  <a
                    href="javascript:;"
                    @click.stop="conditions = true"
                    class="btn-text btn-text--violet"
                  >conditions.</a>
                </div>
              </template>
            </v-checkbox>
          </v-col>
        </v-row>
      </v-container>
      <v-card-actions>
        <v-btn text @click="resetForm">Annuler</v-btn>
        <v-spacer></v-spacer>
        <v-btn
          :disabled="!formIsValid"
          text
          color="colorTertiaryLight"
          type="submit"
        >Créer mon compte</v-btn>
      </v-card-actions>
    </v-form>
    <v-dialog v-model="terms" width="70%">
      <v-card class="colorPrimaryUltraLight">
        <v-card-title class="title colorTertiaryLight--text">Terms</v-card-title>
        <v-card-text v-for="n in 5" :key="n">{{ content }}</v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn text color="colorTertiaryLight" @click="terms = false">Ok</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <v-dialog v-model="conditions" width="70%">
      <v-card class="colorPrimaryUltraLight">
        <v-card-title class="title colorTertiaryLight--text">Conditions</v-card-title>
        <v-card-text v-for="n in 5" :key="n">{{ content }}</v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn text color="colorTertiaryLight" @click="conditions = false">Ok</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-card>
</template>

<script>
export default {
  name: "RegistrarForm",
  data() {
    const defaultForm = Object.freeze({
      username: "",
      email: "",
      password: "",
      job: "",
      terms: false,
    });

    return {
      show1: false,
      form: Object.assign({}, defaultForm),
      rules: {
        password: [
          (val) => (val || "").length > 0 || "Ce champ est obligatoire",
        ],
        username: [
          (val) => (val || "").length > 0 || "Ce champ est obligatoire",
        ],
        email: [(val) => (val || "").length > 0 || "Ce champ est obligatoire"],
      },
      jobs: [
        "Développeur Frontend",
        "Développeur Backend",
        "Développeur Full Stack",
        "Admin sys",
        "cyber sécu",
        "Chef de projet",
        "Autre",
      ],
      content: `Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sodales ligula in libero. Sed dignissim lacinia nunc.`,
      snackbar: false,
      terms: false,
      conditions: false,
      defaultForm,
    };
  },

  computed: {
    formIsValid() {
      return (
        this.form.username &&
        this.form.email &&
        this.form.password &&
        this.form.job &&
        this.form.terms
      );
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

<style scoped lang="scss">
.theme--dark.v-list {
  background-color: #696975;
}
</style>