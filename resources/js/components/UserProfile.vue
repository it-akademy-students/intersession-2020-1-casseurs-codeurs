<template>
  <v-card flat color="colorPrimaryUltraLight" id="user-profile">
    <v-snackbar v-model="snackbar" absolute top right color="colorSecondaryLight">
      <span color="colorPrimary">Congratulations! Your profile has been successfully upgraded !</span>
      <v-icon dark>mdi-checkbox-marked-circle</v-icon>
    </v-snackbar>
    <v-col cols="12">
      <v-row>
        <v-col cols="11">
          <h2
            class="pa-2 text-center"
          >Your Profile:</h2>
        </v-col>
        <v-col cols="1">
          <v-icon @click="initShowForm">mdi-close</v-icon>
        </v-col>
      </v-row>
    </v-col>

    <v-form ref="form" @submit.prevent="submit">
      <v-container fluid>
        <v-row>
          <v-col cols="12">
            <v-text-field
              v-model="form.username"
              :rules="rules.username"
              color="colorTertiaryLight"
              label="Username"
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
              label="Password"
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
              label="Your Job"
              required
            ></v-select>
          </v-col>
        </v-row>
      </v-container>
      <v-card-actions>
        <v-container fluid>
          <v-row>
            <v-col xs="6" md="auto">
              <v-btn text @click="resetForm" class="colorDanger--text">Delete Account</v-btn>
            </v-col>
            <v-col xs="6" md="auto">
              <v-btn
                :disabled="!formIsValid"
                text
                class="colorWarning--text"
                type="submit"
              >Edit Profile</v-btn>
            </v-col>
            <v-col xs="12" md="auto">
              <v-btn text @click="handleLogout" class="colorTertiaryLight--text">Logout</v-btn>
            </v-col>
          </v-row>
        </v-container>
      </v-card-actions>
    </v-form>
  </v-card>
</template>

<script>
import { mapGetters, mapState, mapActions } from 'vuex'

export default {
  name: "UserProfile",
  data() {
    const defaultForm = Object.freeze({
      username: "Isa",
      email: "i@i.dev",
      password: "22222222",
      job: "Full Stack",
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
        "Full Stack",
        "Frontend",
        "Backend",
        "Admin sys",
        "cyber sécu",
        "Chef de projet",
        "Autre",
      ],
      content: `Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sodales ligula in libero. Sed dignissim lacinia nunc.`,
      snackbar: false,
      defaultForm,
    };
  },

  computed: {
    formIsValid() {
      return (
        this.form.username &&
        this.form.email &&
        this.form.password &&
        this.form.job
      );
    },
  },

  methods: {
    ...mapActions([
      "toggleRegisterForm",
      "toggleLoginForm",
      "toggleSignInOn",
      "toggleUserProfile",
      "toggleLoggedIn",
    ]),
    resetForm() {
      this.form = Object.assign({}, this.defaultForm);
      this.$refs.form.reset();
    },
    submit() {
      this.snackbar = true;
      this.resetForm();
    },
    initShowForm() {
      return (
        this.$store.dispatch("toggleLoginForm", false),
        this.$store.dispatch("toggleSignInOn", true),
        this.$store.dispatch("toggleRegisterForm", false),
        this.$store.dispatch("toggleLoggedIn", false),
        this.$store.dispatch("toggleUserProfile", false)
      );
    },
    handleLogout() {
      this.initShowForm();
      return this.$router.push('/')
    },
  },
};
</script>

<style scoped lang="scss">
.theme--dark.v-list {
  background-color: #696975;
}
</style>