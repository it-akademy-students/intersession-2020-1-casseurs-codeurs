<template>
  <v-card flat color="colorPrimaryUltraLight" id="register-form">
    <v-snackbar v-if="success" v-model="snackbar" absolute top right color="colorSecondaryLight">
      <span color="colorPrimary--text">Congratulations! Your profile has been successfully updated!</span>
      <v-icon dark>mdi-checkbox-marked-circle</v-icon>
    </v-snackbar>
    <v-snackbar v-if="has_error && !success" v-model="snackbar" absolute top right color="error">
      <span
        v-if="error == 'registration_validation_error'"
        color="colorPrimary--text"
      >Ooops! Error, can not edit at the moment. If the problem persists, please contact an administrator.</span>
      <span v-if="has_error && errs.name" class="colorPrimary--text">{{ errs.name }}</span>
      <span v-if="has_error && errs.email" class="colorPrimary--text">{{ errs.email }}</span>
      <span v-if="has_error && errs.password" class="colorPrimary--text">{{ errs.password }}</span>
      <v-icon dark>mdi-alert-circle</v-icon>
    </v-snackbar>
    <v-col cols="12">
      <v-col cols="12">
        <v-row>
          <v-col cols="11">
            <h2
              class="pa-2 text-center"
            >You can edit your profile {{ this.$store.getters.getUser.name | capitalize }}:</h2>
          </v-col>
          <v-col cols="1">
            <v-icon @click="handleCancelled">mdi-close</v-icon>
          </v-col>
        </v-row>
      </v-col>
    </v-col>
    <v-form ref="form" name="form" @submit.prevent="updateProfil" method="post">
      <v-container fluid>
        <v-row>
          <v-col cols="12">
            <v-text-field v-model="id" type="text" name="id" label="id" class="d.none" required></v-text-field>
          </v-col>
          <v-col cols="12">
            <v-text-field
              v-model="name"
              type="text"
              name="username"
              label="Username"
              required
              color="colorTertiaryLight"
            ></v-text-field>
          </v-col>
          <v-col cols="12">
            <v-text-field
              v-model="email"
              type="email"
              name="email"
              label="Email"
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
              label="Password"
              hint="Minimum 8 characters"
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
              label="Password Confirmation"
              hint="Minimum 8 characters"
              required
              color="colorTertiaryLight"
              @click:append="show1 = !show1"
            ></v-text-field>
          </v-col>

          <v-col cols="12">
            <v-text-field
              v-model="job"
              type="text"
              name="job"
              label="Your Job"
              color="colorTertiaryLight"
            ></v-text-field>
          </v-col>
        </v-row>
      </v-container>
      <v-card-actions>
        <v-btn text @click="handleCancelled">Cancel</v-btn>
        <v-spacer></v-spacer>
        <v-btn
          :disabled="!formIsValid"
          text
          color="colorTertiaryLight"
          type="submit"
        >Edit my account</v-btn>
      </v-card-actions>
    </v-form>
  </v-card>
</template>

<script>
import { mapGetters, mapState, mapActions } from "vuex";

export default {
  name: "EditProfileForm",
  data() {
    const defaultForm = Object.freeze({
      id: "",
      name: "",
      email: "",
      password: "",
      password_confirmation: "",
      job: "",
    });
    return {
      show1: false,
      // @TODO : fix snackbar
    //   @TODO : fix display user datas
      id: this.$store.getters.getUser.id,
      name: this.$store.getters.getUser.name,
      email: this.$store.getters.getUser.email,
      password: this.$store.getters.getUser.password,
      password_confirmation: this.$store.getters.getUser.password,
      job: this.$store.getters.getUser.job,
      snackbar: false,
      defaultForm,
      has_error: false,
      error: "",
      errs: {},
      success: false,
    };
  },
  computed: {
    formIsValid() {
      return (
        this.id &&
        this.name &&
        this.email &&
        this.password &&
        this.password_confirmation &&
        this.job
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
      "toggleEditProfile",
    ]),
    // @TODO : handle update and delete User
    updateProfil() {
      var app = this;
      this.$auth
        .user({
          name: app.name,
          email: app.email,
          password: app.password,
          password_confirmation: app.password_confirmation,
          job: app.job,
        })
        .then(
          (succ) => {
            console.log(succ.data.status);
            return (
              (app.success = true),
              (app.snackbar = true),
              this.$store.dispatch("setUser", succ.data.data),
              this.resetForm(),
              this.initShowForm()
            );
          },
          (err) => {
            console.log({ err });
            return (
              (app.snackbar = true),
              (app.success = false),
              console.log(err.response.data.status),
              console.log(err.response.data.errors),
              (app.has_error = true),
              (app.error = err.response.data.error),
              (app.errs = err.response.data.errors || {})
            );
          }
        );
    },
    resetForm() {
      this.form = Object.assign({}, this.defaultForm);
      this.$refs.form.reset();
    },
    initShowForm() {
      return (
        this.$store.dispatch("toggleLoginForm", false),
        this.$store.dispatch("toggleSignInOn", false),
        this.$store.dispatch("toggleRegisterForm", false),
        this.$store.dispatch("toggleLoggedIn", false),
        this.$store.dispatch("toggleUserProfile", true),
        this.$store.dispatch("toggleEditProfile", false)
      );
    },
    handleCancelled() {
      return this.resetForm(), this.initShowForm();
    },
  },
};
</script>

<style scoped lang="scss">
.theme--dark.v-list {
  background-color: #696975;
}
</style>