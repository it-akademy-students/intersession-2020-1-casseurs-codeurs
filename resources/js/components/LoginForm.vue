<template>
  <v-card flat color="colorPrimaryUltraLight" id="login-form">
    <v-snackbar v-model="snackbar" absolute top right color="colorSecondaryLight">
      <span color="colorPrimary">Glad to see you again! You are now logged in!</span>
      <v-icon dark>mdi-checkbox-marked-circle</v-icon>
    </v-snackbar>
    <v-col cols="12">
      <v-row>
        <v-col cols="11">
          <h2 class="pa-2 text-center">Please enter your username and password to login.</h2>
        </v-col>
        <v-col cols="1">
          <v-icon @click="initShowForm">mdi-close</v-icon>
        </v-col>
      </v-row>
    </v-col>
    <v-form ref="form" name="form" @submit.prevent="login" method="post">
      <v-container fluid>
        <v-row>
          <v-col cols="12">
            <v-text-field
              v-model="email"
              required
              type="email"
              name="email"
              label="Email"
              color="colorTertiaryLight"
            ></v-text-field>
          </v-col>
          <v-col cols="12">
            <v-text-field
              :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
              v-model="password"
              required
              :type="show1 ? 'text' : 'password'"
              name="password"
              label="Password"
              hint="Minimum 8 characters"
              color="colorTertiaryLight"
              @click:append="show1 = !show1"
            ></v-text-field>
          </v-col>
        </v-row>
      </v-container>
      <v-card-actions>
        <v-btn text @click="resetForm" class="colorTertiaryLight--text">Forgot password?</v-btn>
        <v-spacer></v-spacer>
        <v-btn :disabled="!formIsValid" text class="colorTertiaryLight--text" type="submit">Log In</v-btn>
      </v-card-actions>
    </v-form>
  </v-card>
</template>

<script>
import { mapGetters, mapState, mapActions } from "vuex";

export default {
  name: "LoginForm",
  data() {
    const defaultForm = Object.freeze({
      email: "",
      password: "",
    });
    return {
      show1: false,
      snackbar: false,
      defaultForm,
      success: false,
      has_error: false,
      error: "",
      email: "",
      password: "",
    };
  },
  computed: {
    // loggedIn() {
    //   return this.$store.state.auth.status.loggedIn;
    // },
    formIsValid() {
      return this.email && this.password;
    },
  },
  // created() {
  //   if (this.loggedIn) {
  //     this.showLoggedIn();
  //     // this.$router.push("/profile");
  //   }
  // },
  methods: {
    ...mapActions(["toggleLoginForm", "toggleSignInOn"]),
    resetForm() {
      this.form = Object.assign({}, this.defaultForm);
      this.$refs.form.reset();
    },
    showLoggedIn() {
      return (
        this.$store.dispatch("toggleLoginForm", false),
        this.$store.dispatch("toggleSignInOn", false),
        this.$store.dispatch("toggleRegisterForm", false),
        this.$store.dispatch("toggleLoggedIn", true),
        this.$store.dispatch("toggleUserProfile", false)
      );
    },
    initShowForm() {
      return (
        this.$store.dispatch("toggleSignInOn", true),
        this.$store.dispatch("toggleLoginForm", false)
      );
    },
    login() {
      // get the redirect object

      var redirect = this.$auth.redirect();
      var app = this;
      this.$auth.login({
        data: {
          email: app.email,
          password: app.password,
        },
        success: function () {
          // handle redirection
          app.success = true;
          snackbar = true;
          this.showLoggedIn();
          // const redirectTo = "dashboard";
          // this.$router.push({ name: redirectTo });
        },
        error: function () {
          app.has_error = true;
          app.error = res.response.data.error;
          this.initShowForm();
        },
        rememberMe: true,
        fetchUser: true,
      });
    },
  },
};
</script>
