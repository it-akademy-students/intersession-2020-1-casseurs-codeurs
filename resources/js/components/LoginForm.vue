<template>
  <v-card flat color="colorPrimaryUltraLight" id="login-form">
    <v-snackbar
      v-if="snackbar && success"
      v-model="snackbar"
      absolute
      top
      right
      color="colorSecondaryLight"
    >
      <span color="colorPrimary--text">{{ $tc("loginForm.snackBar.success", 1) }}</span>
      <v-icon dark>mdi-checkbox-marked-circle</v-icon>
    </v-snackbar>
    <v-snackbar
      v-if="snackbar && has_error && !success"
      v-model="snackbar"
      absolute
      top
      right
      color="error"
    >
      <span
        v-if="this.error == 'login_error'"
        color="colorPrimary--text"
      >Ooops! {{ this.error }} {{ $tc("loginForm.snackBar.error", 1) }}</span>
      <v-icon dark>mdi-alert-circle</v-icon>
    </v-snackbar>
    <v-col cols="12">
      <v-row>
        <v-col cols="11">
          <h2 class="pa-2 text-center">{{ $tc("loginForm.title", 1) }}</h2>
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
              :label="$tc('loginForm.form.labelEmail', 1)"
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
              :label="$tc('loginForm.form.labelPwd', 1)"
              :hint="$tc('loginForm.form.hint', 1)"
              color="colorTertiaryLight"
              @click:append="show1 = !show1"
            ></v-text-field>
          </v-col>
        </v-row>
      </v-container>
      <v-card-actions>
        <v-btn
          text
          @click="resetForm"
          class="colorTertiaryLight--text"
        >{{ $tc("loginForm.actions.forgotPwd", 1) }}</v-btn>
        <v-spacer></v-spacer>
        <v-btn
          :disabled="!formIsValid"
          text
          class="colorTertiaryLight--text"
          type="submit"
        >{{ $tc("loginForm.actions.login", 1) }}</v-btn>
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
    formIsValid() {
      return this.email && this.password;
    },
  },
  methods: {
    ...mapActions([
      "toggleLoginForm",
      "toggleSignInOn",
      "toggleRegisterForm",
      "toggleLoggedIn",
      "toggleUserProfile",
      "toggleEditProfile",
      "setUser",
    ]),
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
        this.$store.dispatch("toggleUserProfile", false),
        this.$store.dispatch("toggleEditProfile", false),
        this.$router.push({ name: "user" })
      );
    },
    initShowForm() {
      return (
        this.$store.dispatch("toggleLoginForm", false),
        this.$store.dispatch("toggleSignInOn", true),
        this.$store.dispatch("toggleRegisterForm", false),
        this.$store.dispatch("toggleLoggedIn", false),
        this.$store.dispatch("toggleUserProfile", false),
        this.$store.dispatch("toggleEditProfile", false),
        this.$router.push({ name: "home" })
      );
    },
    login() {
      // get the redirect object
      var redirect = this.$auth.redirect();
      var app = this;
      this.$auth
        .login({
          data: {
            email: app.email,
            password: app.password,
          },
          staySignedIn: true,
          fetchUser: true,
          redirect: null,
        })
        .then(
          (succ) => {
            return (
              (app.success = true),
              (app.snackbar = true),
              this.showLoggedIn(),
              this.resetForm(),
              this.$store.dispatch("setUser", succ.data.data),
              this.$router.push({ name: "user" })
            );
          },
          (err) => {
            app.success = false;
            app.snackbar = true;
            app.has_error = true;
            app.error = err.response.data.error;
          }
        );
    },
  },
};
</script>
