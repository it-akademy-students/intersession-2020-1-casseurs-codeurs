<template>
  <v-container fluid>
    <v-row align-content="center" justify="space-around" no-gutters>
      <v-col cols="12">
        <v-row justify="center">
          <h2 class="my-5 pa-4 text-center">{{ $tc("signInOn.title", 1) }}</h2>
        </v-row>
      </v-col>
      <v-col cols="12">
        <v-row justify="center">
          <button
            class="my-5 btn btn--violet"
            style="min-width:20ch;"
            @click="showLoginForm"
          >{{ $tc("signInOn.actions.signIn", 1) }}</button>
        </v-row>
      </v-col>
      <v-col cols="12">
        <v-row justify="center">
          <button
            class="my-5 btn btn--violet"
            style="min-width:20ch;"
            @click="showRegisterForm"
          >{{ $tc("signInOn.actions.signUp", 1) }}</button>
        </v-row>
      </v-col>
      <v-col cols="12">
        <h3 class="mt-5 pa-4">{{ $tc("signInOn.whyTitle", 1) }}</h3>
      </v-col>
      <v-col cols="12">
        <p class="mb-5 pa-4 text-left">{{ $tc("signInOn.whyText", 1) }}</p>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import { mapGetters, mapState, mapActions } from "vuex";

export default {
  name: "SignInOn",
  methods: {
    ...mapActions([
      "toggleRegisterForm",
      "toggleLoginForm",
      "toggleSignInOn",
      "toggleUserProfile",
      "toggleLoggedIn",
      "toggleEditProfile",
    ]),
    showLoginForm() {
      return (
        this.$store.dispatch("toggleLoginForm", true),
        this.$store.dispatch("toggleSignInOn", false),
        this.$store.dispatch("toggleEditProfile", false),
        this.$store.dispatch("toggleRegisterForm", false),
        this.$store.dispatch("toggleLoggedIn", false),
        this.$store.dispatch("toggleUserProfile", false),
        this.$router.push({ name: "home-login" })
      );
    },
    showRegisterForm() {
      return (
        this.$store.dispatch("toggleLoginForm", false),
        this.$store.dispatch("toggleSignInOn", false),
        this.$store.dispatch("toggleEditProfile", false),
        this.$store.dispatch("toggleRegisterForm", true),
        this.$store.dispatch("toggleLoggedIn", false),
        this.$store.dispatch("toggleUserProfile", false),
        this.$router.push({ name: "home-register" })
      );
    },
  },
};
</script>