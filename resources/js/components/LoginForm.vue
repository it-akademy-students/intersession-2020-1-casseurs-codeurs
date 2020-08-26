<template>
  <v-card flat color="colorPrimaryUltraLight" id="login-form">
    <v-snackbar v-model="snackbar" absolute top right color="colorSecondaryLight">
      <span color="colorPrimary">Glad to see you again! You are now logged in!</span>
      <v-icon dark>mdi-checkbox-marked-circle</v-icon>
    </v-snackbar>
    <v-col cols="12">
      <v-row>
        <v-col cols="11">
          <h2
            class="pa-2 text-center"
          >Please enter your username and password to login..</h2>
        </v-col>
        <v-col cols="1">
          <v-icon @click="initShowForm">mdi-close</v-icon>
        </v-col>
      </v-row>
    </v-col>
    <v-form name="form" ref="form" @submit.prevent="handleLogin">
      <v-container fluid>
        <v-row>
          <v-col cols="12">
            <v-text-field
              v-model="user.username"
              v-validate="'required'"
              type="text"
              class="form-control"
              name="username"
              color="colorTertiaryLight"
              label="username"
            ></v-text-field>
          </v-col>
          <v-col cols="12">
            <v-text-field
              :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
              v-model="user.password"
              v-validate="'required'"
              :type="show1 ? 'text' : 'password'"
              class="form-control"
              name="password"
              label="password"
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
        <v-btn
          :disabled="!formIsValid"
          text
          class="colorTertiaryLight--text"
          type="submit"
        >Log In</v-btn>
      </v-card-actions>
    </v-form>
  </v-card>
</template>

<script>
import User from "@/models/user";

import { mapGetters, mapState, mapActions } from 'vuex'

export default {
  name: "LoginForm",
  data() {
    const defaultForm = Object.freeze({
      username: "",
      password: "",
    });
    return {
      user: new User("", ""),
      loading: false,
      message: "",
      show1: false,
      snackbar: false,
      defaultForm,
    };
  },
  computed: {
    loggedIn() {
      return this.$store.state.auth.status.loggedIn;
    },
    formIsValid() {
      return this.user.username && this.user.password;
    },
  },
  created() {
    if (this.loggedIn) {
      this.showLoggedIn()
      // this.$router.push("/profile");
    }
  },
  methods: {
    ...mapActions([
        'toggleLoginForm',
        'toggleSignInOn',
    ]),
    resetForm() {
      this.form = Object.assign({}, this.defaultForm);
      this.$refs.form.reset();
    },
    handleLogin() {
      this.loading = true;
      this.$validator.validateAll().then((isValid) => {
        if (!isValid) {
          this.loading = false;
          return;
        }

        if (this.user.username && this.user.password) {
          this.$store.dispatch("auth/login", this.user).then(
            () => {
              this.showLoggedIn()
              // this.$router.push("/profile");
            },
            (error) => {
              this.loading = false;
              this.message =
                (error.response && error.response.data) ||
                error.message ||
                error.toString();
            }
          );
        }
      });
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
        this.$store.dispatch('toggleSignInOn', true), this.$store.dispatch('toggleLoginForm', false)
      );
    },
  },
};
</script>
