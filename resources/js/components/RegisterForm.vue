<template>
  <v-card flat color="colorPrimaryUltraLight" id="register-form">
    <v-col cols="12">
      <v-row justify="end" class="pa-0 ma-0">
        <v-col cols="1">
          <v-icon @click="initShowForm">mdi-close</v-icon>
        </v-col>
      </v-row>
      <v-row>
        <v-col cols="12">
          <h2
            :class="{
              'subtitle-2 pa-2 text-center ': $vuetify.breakpoint.smAndDown,
              'pa-2 text-center': $vuetify.breakpoint.mdAndUp,
            }"
          >
            {{ $tc("register.title", 1) }}
          </h2>
        </v-col>
      </v-row>
    </v-col>
    <v-form ref="form" name="form" @submit.prevent="register" method="post">
      <v-container fluid>
        <v-row>
          <v-col cols="12">
            <v-text-field
              v-model="name"
              type="text"
              name="username"
              :label="$tc('register.form.labelName', 1)"
              required
              color="colorTertiaryLight"
            ></v-text-field>
          </v-col>
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

          <v-col cols="12">
            <v-select
              v-model="job"
              :items="$t('register.form.jobs')"
              :label="$tc('register.form.labelJob', 1)"
              name="job"
              color="colorTertiaryLight"
            ></v-select>
          </v-col>
          <v-col cols="12">
            <v-checkbox v-model="accept_terms" color="colorTertiaryLight">
              <template v-slot:label>
                <div @click.stop>
                  {{ $tc("register.form.acceptTerms", 1) }}
                  <a
                    href="javascript:;"
                    @click.stop="terms = true"
                    class="btn-text btn-text--violet"
                    >{{ $tc("register.form.termsLink", 1) }}</a
                  >
                </div>
              </template>
            </v-checkbox>
          </v-col>
        </v-row>
      </v-container>
      <v-card-actions>
        <v-btn text @click="handleCancelled">{{
          $tc("register.form.cancel", 1)
        }}</v-btn>
        <v-spacer></v-spacer>
        <v-btn
          :disabled="!formIsValid"
          text
          color="colorTertiaryLight"
          type="submit"
          >{{ $tc("register.form.create", 1) }}</v-btn
        >
      </v-card-actions>
      <!-- snackbar user feed-back -->
      <v-snackbar
        v-if="snackbar && success"
        v-model="snackbar"
        absolute
        top
        right
        color="colorSecondaryLight"
      >
        <span color="colorPrimary--text">{{
          $tc("register.snackBar.success", 1)
        }}</span>
        <v-icon dark>mdi-checkbox-marked-circle</v-icon>
      </v-snackbar>
      <v-snackbar
        v-if="snackbar && has_error && !success"
        v-model="snackbar"
        absolute
        bottom
        right
        color="error"
      >
        <span
          v-if="error == 'registration_validation_error'"
          color="colorPrimary--text"
          >{{ $tc("register.snackBar.error", 1) }}</span
        >
        <span v-if="has_error && errs.name" class="colorPrimary--text">{{
          errs.name
        }}</span>
        <span v-if="has_error && errs.email" class="colorPrimary--text">{{
          errs.email
        }}</span>
        <span v-if="has_error && errs.password" class="colorPrimary--text">{{
          errs.password
        }}</span>
        <v-icon dark>mdi-alert-circle</v-icon>
      </v-snackbar>
    </v-form>
    <v-dialog v-model="terms" width="70%">
      <v-card class="colorPrimaryUltraLight">
        <v-card-title class="title colorTertiaryLight--text">{{
          $tc("register.termsTitle", 1)
        }}</v-card-title>
        <v-card-text>{{ $tc("register.termsText", 1) }}</v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn text color="colorTertiaryLight" @click="terms = false"
            >Ok</v-btn
          >
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-card>
</template>

<script>
export default {
  name: "RegisterForm",
  data() {
    const defaultForm = Object.freeze({
      name: "",
      email: "",
      password: "",
      password_confirmation: "",
      job: "",
      accept_terms: false,
    });

    return {
      show1: false,
      form: Object.assign({}, defaultForm),
      name: "",
      email: "",
      password: "",
      password_confirmation: "",
      job: "",
      accept_terms: false,
      terms: false,
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
        this.name &&
        this.email &&
        this.password &&
        this.password_confirmation &&
        this.job &&
        this.accept_terms
      );
    },
  },
  methods: {
    register() {
      var app = this;
      this.$auth
        .register({
          data: {
            name: app.name,
            email: app.email,
            password: app.password,
            password_confirmation: app.password_confirmation,
            job: app.job,
          },
          redirect: null,
        })
        .then(
          (succ) => {
            return (
              (app.success = true),
              (app.snackbar = true),
              this.resetForm(),
              this.$router.push({
                name: "home-login",
                params: { successRegistrationRedirect: true },
              })
            );
          },
          (err) => {
            return (
              (app.snackbar = true),
              (app.success = false),
              (app.has_error = true),
              (app.error = err.response.data.error),
              (app.errs = err.response.data.errors || {})
            );
          }
        );
    },
    resetForm() {
      this.form = Object.assign({}, this.defaultForm);
    },
    initShowForm() {
      return this.$router.push({ name: "home" });
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