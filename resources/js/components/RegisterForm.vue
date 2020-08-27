<template>
  <v-card flat color="colorPrimaryUltraLight" id="register-form">
    <div class="alert alert-danger" v-if="has_error && !success">
      <p v-if="error == 'registration_validation_error'">Validation Errors.</p>
      <p
        v-else
      >Error, can not register at the moment. If the problem persists, please contact an administrator.</p>
    </div>

    <v-snackbar v-model="snackbar" absolute top right color="colorSecondaryLight">
      <span color="colorPrimary">Congratulations! Your account have been successfully created !</span>
      <v-icon dark>mdi-checkbox-marked-circle</v-icon>
    </v-snackbar>
    <v-col cols="12">
      <v-row>
        <v-col cols="11">
          <h2
            class="pa-2 text-center"
          >Register to benefit from all the features of the SWAPP application</h2>
        </v-col>
        <v-col cols="1">
          <v-icon @click="initShowForm">mdi-close</v-icon>
        </v-col>
      </v-row>
    </v-col>
    <!-- <v-form ref="form" @submit.prevent="handleRegister"> -->
    <v-form ref="form" @submit.prevent="register" v-if="!success" method="post">
      <v-container fluid>
        <v-row>
          <v-col cols="12">
            <div class="form-group" v-bind:class="{ 'has-error': has_error && errors.name }">
              <v-text-field
                v-model="name"
                v-validate="'required|min:3|max:20'"
                type="text"
                name="username"
                color="colorTertiaryLight"
                label="Username"
              ></v-text-field>
              <span class="help-block" v-if="has_error && errors.name">{{ errors.name }}</span>
            </div>
          </v-col>
          <v-col cols="12">
            <div class="form-group" v-bind:class="{ 'has-error': has_error && errors.email }">
              <v-text-field
                v-model="email"
                v-validate="'required|email|max:50'"
                type="email"
                name="email"
                color="colorTertiaryLight"
                label="Email"
              ></v-text-field>
              <span class="help-block" v-if="has_error && errors.email">{{ errors.email }}</span>
            </div>
          </v-col>
          <v-col cols="12">
            <div class="form-group" v-bind:class="{ 'has-error': has_error && errors.password }">
              <v-text-field
                v-model="password"
                v-validate="'required|min:6|max:40'"
                name="password"
                :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
                :type="show1 ? 'text' : 'password'"
                label="Password"
                hint="Minimum 8 characters"
                color="colorTertiaryLight"
                @click:append="show1 = !show1"
              ></v-text-field>
              <span class="help-block" v-if="has_error && errors.password">{{ errors.password }}</span>
            </div>
          </v-col>

          <v-col cols="12">
            <div class="form-group" v-bind:class="{ 'has-error': has_error && errors.password }">
              <v-text-field
                v-model="password_confirmation"
                v-validate="'required|min:6|max:40'"
                name="password_confirmation"
                :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
                :type="show1 ? 'text' : 'password'"
                label="Password Confirmation"
                hint="Minimum 8 characters"
                color="colorTertiaryLight"
                @click:append="show1 = !show1"
              ></v-text-field>
            </div>
          </v-col>

          <v-col cols="12">
            <div class="form-group" v-bind:class="{ 'has-error': has_error && errors.job }">
              <v-select
                v-model="user.job"
                :items="jobs"
                color="colorTertiaryLight"
                label="Your Job"
                name="job"
                required
              ></v-select>

              <span class="help-block" v-if="has_error && errors.job">{{ errors.job }}</span>
            </div>
          </v-col>
          <v-col cols="12">
            <v-checkbox v-model="form.terms" color="colorTertiaryLight">
              <template v-slot:label>
                <div @click.stop>
                  Please read and accept
                  <a
                    href="javascript:;"
                    @click.stop="terms = true"
                    class="btn-text btn-text--violet"
                  >terms</a>
                  and
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
        <v-btn text @click="handleCancelled">Cancel</v-btn>
        <v-spacer></v-spacer>
        <v-btn
          :disabled="!formIsValid"
          text
          color="colorTertiaryLight"
          type="submit"
        >Create my account</v-btn>
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
import User from "@/models/user";
import { mapGetters, mapState, mapActions } from "vuex";

export default {
  name: "RegisterForm",
  data() {
    const defaultForm = Object.freeze({
      name: "",
      email: "",
      password: "",
      password_confirmation: "",
      job: "",
      terms: false,
      conditions: false,
    });

    return {
      show1: false,
      form: Object.assign({}, defaultForm),
      jobs: [
        "Frontend Developer",
        "Backend Developer",
        "Full Stack Developer",
        "Admin sys",
        "Cyber Security",
        "Project Manager",
        "Other",
      ],
      content: `Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sodales ligula in libero. Sed dignissim lacinia nunc.`,
      snackbar: false,
      terms: false,
      conditions: false,
      defaultForm,
      has_error: false,
      error: "",
      errors: {},
      success: false,
    };
  },

  // computed: {
  //   formIsValid() {
  //     return (
  //       this.form.username &&
  //       this.form.email &&
  //       this.form.password &&
  //       this.form.job &&
  //       this.form.terms
  //     );
  //   },

  // },
  // methods: {
  //   resetForm() {
  //     this.form = Object.assign({}, this.defaultForm);
  //     this.$refs.form.reset();
  //   },
  //   submit() {
  //     this.resetForm();
  //     this.snackbar = true;
  //   },
  // },

  computed: {
    loggedIn() {
      return this.$store.state.auth.status.loggedIn;
    },
    formIsValid() {
      return (
        this.user.username &&
        this.user.email &&
        this.user.password &&
        this.user.job &&
        this.form.terms
      );
    },
  },
  mounted() {
    if (this.loggedIn) {
      this.$router.push("/profile");
    }
  },
  methods: {
    ...mapActions(["toggleRegisterForm", "toggleSignInOn"]),
    register() {
      var app = this;
      this.$auth.register({
        data: {
          name: app.name,
          email: app.email,
          password: app.password,
          password_confirmation: app.password_confirmation,
        },
        success: function () {
          app.success = true;
          this.$router.push({
            name: "login",
            params: { successRegistrationRedirect: true },
          });
        },
        error: function (res) {
          // console.log(res.response.data.errors)
          app.has_error = true;
          app.error = res.response.data.error;
          app.errors = res.response.data.errors || {};
        },
      });
    },
    resetForm() {
      this.form = Object.assign({}, this.defaultForm);
      this.$refs.form.reset();
    },
    initShowForm() {
      return (
        this.$store.dispatch("toggleSignInOn", true),
        this.$store.dispatch("toggleRegisterForm", false)
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