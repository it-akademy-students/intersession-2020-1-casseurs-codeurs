<template>
  <v-card flat color="colorPrimaryUltraLight" id="register-form">
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
    <v-form ref="form" name="form" @submit.prevent="register" method="post">
      <v-container fluid>
        <v-row>
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
            <v-select
              v-model="job"
              :items="jobs"
              label="Your Job"
              name="job"
              required
              color="colorTertiaryLight"
            ></v-select>
          </v-col>
          <v-col cols="12">
            <v-checkbox v-model="accept_terms" color="colorTertiaryLight">
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
      jobs: [
        "Frontend Developer",
        "Backend Developer",
        "Full Stack Developer",
        "Admin sys",
        "Cyber Security",
        "Project Manager",
        "Other",
      ],
      accept_terms: false,
      terms: false,
      conditions: false,
      content: `Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sodales ligula in libero. Sed dignissim lacinia nunc.`,
      snackbar: false,
      defaultForm,
      has_error: false,
      error: "",
      // errors: {},
      success: false,
    };
  },

  computed: {
    // loggedIn() {
    //   return this.$store.state.auth.status.loggedIn;
    // },
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
  // mounted() {
  //   if (this.loggedIn) {
  //     this.$router.push("/profile");
  //   }
  // },
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
          job: app.job,
        },
        success: function () {
          app.success = true;

          // this.$router.push({
          //   name: "login",
          //   params: { successRegistrationRedirect: true },
          // });
          return (
            this.$store.dispatch("toggleLoginForm", true),
            this.$store.dispatch("toggleSignInOn", false)
          );
        },
        error: function (res) {
          console.log(res.response.data.errors);
          app.has_error = true;
          app.error = res.response.data.error;
          // app.errors = res.response.data.errors || {};
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