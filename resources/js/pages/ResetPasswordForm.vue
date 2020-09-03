<template>
    <v-container class="pa-5 mt-16">
    <v-row justify="center" align="center" class="pa-5 mb-5 mt-16">
      <h2 class="display-1 text-center pa-md-4 ma-auto">Réinitialisez votre mot de passe</h2>
    </v-row>
    <v-spacer></v-spacer>
    <v-row justify="center" align="center" class="pa-5 my-5">
      <v-snackbar
      v-if="snackbar && success"
      v-model="snackbar"
      absolute
      top
      right
      color="colorSecondaryLight"
    >
      <span color="colorPrimary--text">{{ $tc("resetPasswordForm.snackBar.success", 1) }}</span>
      <v-icon dark>mdi-checkbox-marked-circle</v-icon>
    </v-snackbar>
      
      <v-form ref="form" name="form" @submit.prevent="changePassword" method="post">
      <v-container fluid>
        <v-row>
          
          <v-col cols="12">
            <v-text-field
              v-model="email"
              type="email"
              name="email"
              :label="$tc('register.form.labelEmail', 1)"
              required
              color="colorTertiaryLight"
            ></v-text-field>
          </v-col>
          <v-col cols="12">
            <v-text-field
              v-model="password"
              :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
              :type="show1 ? 'text' : 'password'"
              name="password"
              :label="$tc('register.form.labelPwd', 1)"
              :hint="$tc('register.form.hint')"
              required
              color="colorTertiaryLight"
              @click:append="show1 = !show1"
            ></v-text-field>
          </v-col>

          <v-col cols="12">
            <v-text-field
              v-model="password_confirmation"
              :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
              :type="show1 ? 'text' : 'password'"
              name="password_confirmation"
              :label="$tc('register.form.labelPwdConfirm', 1)"
              :hint="$tc('register.form.hint')"
              required
              color="colorTertiaryLight"
              @click:append="show1 = !show1"
            ></v-text-field>
          </v-col>

        
        </v-row>
      </v-container>
      <v-card-actions>
        <!-- <v-btn text @click="handleCancelled">{{ $tc("register.form.cancel", 1) }}</v-btn> -->
        <v-spacer></v-spacer>
        <v-btn
          text
          color="colorTertiaryLight"
          type="submit"
        >Valider mon nouveau mot de passe</v-btn>
      </v-card-actions>
    </v-form>


    </v-row>
  </v-container>
</template>
<script>

import { mapGetters, mapState, mapActions } from "vuex";

export default {
    name: "ResetPasswordForm",
    data() {
      return {
        show1: false,
        snackbar: false,
        success: false,
        token: null,
        email: null,
        password: null,
        password_confirmation: null,
        has_error: false
      }
    },
    methods: {
        ...mapActions([
        "toggleRegisterForm",
        "toggleSignInOn",
        "toggleLoginForm",
        "toggleEditProfile",
        "toggleUserProfile",
        "toggleLoggedIn",
      ]),

        changePassword() {

            this.axios.post("/auth/reset/password/", {
                token: this.$route.params.token,
                email: this.email,
                password: this.password,
                password_confirmation: this.password_confirmation
            })
            .then(result => {
                // console.log(result.data);
                (this.success = true),
                (this.snackbar = true),
                this.$store.dispatch("toggleLoginForm", true),
                this.$store.dispatch("toggleSignInOn", false),
                this.$store.dispatch("toggleRegisterForm", false),
                this.$store.dispatch("toggleLoggedIn", false),
                this.$store.dispatch("toggleUserProfile", false),
                this.$store.dispatch("toggleEditProfile", false),
                this.$router.push({name: 'home-login'})
                
            }, error => {
                console.error(error);
            });
        }
    }
}
</script>