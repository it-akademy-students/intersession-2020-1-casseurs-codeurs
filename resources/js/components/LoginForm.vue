<template>
  <v-card flat color="colorPrimaryUltraLight" id="login-form">
    <v-col cols="12">
      <v-row justify="end" class="pa-0 ma-0">
        <v-col cols="1">
          <v-icon @click="initShowForm">mdi-close</v-icon>
        </v-col>
      </v-row>
      <v-row>
        <v-col cols="12">
          <h2 class="pa-2 text-center">{{ $tc("loginForm.title", 1) }}</h2>
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
          @click="forgotPwd = true"
          class="colorTertiaryLight--text"
          >{{ $tc("loginForm.actions.forgotPwd", 1) }}</v-btn
        >
        <v-spacer></v-spacer>
        <v-btn
          :disabled="!formIsValid"
          text
          class="colorTertiaryLight--text"
          type="submit"
          >{{ $tc("loginForm.actions.login", 1) }}</v-btn
        >
      </v-card-actions>
      <!-- snackbar user feed-back -->
      <v-snackbar
        v-if="snackbar && has_error && !success"
        v-model="snackbar"
        absolute
        top
        right
        color="error"
      >
        <span v-if="this.error == 'login_error'" color="colorPrimary--text"
          >{{ $tc("mainWelcomeDonate.welcomeModale.error", 1) }},
          {{ this.error }} {{ $tc("loginForm.snackBar.error", 1) }}</span
        >
        <v-icon dark>mdi-alert-circle</v-icon>
      </v-snackbar>
    </v-form>

    <!--Reset password form -->
    <v-dialog v-model="forgotPwd" width="70%">
      <v-card class="colorPrimaryUltraLight">
        <v-snackbar
          v-if="snackbar && success"
          v-model="snackbar"
          absolute
          top
          right
          color="colorSecondaryLight"
        >
          <span color="colorPrimary--text">{{
            $tc("loginForm.snackBar.success", 1)
          }}</span>
          <v-icon dark>mdi-checkbox-marked-circle</v-icon>
        </v-snackbar>
        <v-col cols="12">
          <v-row>
            <v-col cols="11">
              <v-card-title class="title colorTertiaryLight--text">{{
                $tc("forgotPwd.title", 1)
              }}</v-card-title>
            </v-col>
            <v-col cols="1">
              <v-icon @click="initShowForm">mdi-close</v-icon>
            </v-col>
          </v-row>
        </v-col>
        <v-card-text>{{ $tc("forgotPwd.subtitle", 1) }}</v-card-text>

        <v-form name="reset-form" @submit.prevent="resetPwd" method="post">
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
            </v-row>
          </v-container>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn text class="colorTertiaryLight--text" type="submit">{{
              $tc("forgotPwd.action", 1)
            }}</v-btn>
          </v-card-actions>
        </v-form>
      </v-card>
    </v-dialog>
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
      snackbar: false,
      defaultForm,
      success: false,
      has_error: false,
      error: "",
      email: "",
      password: "",
      forgotPwd: false,
    };
  },
  computed: {
    formIsValid() {
      return this.email && this.password;
    },
  },
  methods: {
    resetForm() {
      this.form = Object.assign({}, this.defaultForm);
    },
    showLoggedIn() {
      return this.$router.push({ name: "user" });
    },
    initShowForm() {
      return this.$router.push({ name: "home" });
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
              this.$router.push({ name: "user" })
            );
          },
          (err) => {
            console.log({ err });
            app.success = false;
            app.snackbar = true;
            app.has_error = true;
            app.error = err.response.data.error;
          }
        );
    },
    // Reset user password
    resetPwd() {
      let app = this;
      let url = `/auth/reset-password`;
      let data = new FormData();
      data.append("email", this.email);

      let header = {
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
      };
      this.axios
        .post(url, data, header)
        .then((response) => {
          return (app.success = true), (app.snackbar = true);
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>
