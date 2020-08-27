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
    <v-form ref="form" @submit.prevent="handleRegister">
      <v-container fluid>
        <v-row>
          <v-col cols="12">
            <v-text-field
              v-model="user.username"
              v-validate="'required|min:3|max:20'"
              type="text"
              name="username"
              color="colorTertiaryLight"
              label="Username"
            ></v-text-field>
          </v-col>
          <v-col cols="12">
            <v-text-field
              v-model="user.email"
              v-validate="'required|email|max:50'"
              type="email"
              name="email"
              color="colorTertiaryLight"
              label="Email"
            ></v-text-field>
          </v-col>
          <v-col cols="12">
            <v-text-field
              v-model="user.password"
              v-validate="'required|min:6|max:40'"
              name="password"
              :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
              :type="show1 ? 'text' : 'password'"
              label="Password"
              hint="Minimum 8 characters"
              color="colorTertiaryLight"
              @click:append="show1 = !show1"
            ></v-text-field>
          </v-col>
          <v-col cols="12">
            <v-select
              v-model="user.job"
              :items="jobs"
              color="colorTertiaryLight"
              label="Your Job"
              name="job"
              required
            ></v-select>
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
import { mapGetters, mapState, mapActions } from 'vuex'

export default {
  name: "RegisterForm",
  data() {
    const defaultForm = Object.freeze({
      username: "",
      email: "",
      password: "",
      job: "",
      terms: false,
    });

    return {
      show1: false,
      form: Object.assign({}, defaultForm),

      // rules: {
      //   password: [
      //     (val) => (val || "").length > 0 || "Ce champ est obligatoire",
      //   ],
      //   username: [
      //     (val) => (val || "").length > 0 || "Ce champ est obligatoire",
      //   ],
      //   email: [(val) => (val || "").length > 0 || "Ce champ est obligatoire"],
      // },
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
      user: new User("", "", ""),
      submitted: false,
      successful: false,
      message: "",
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
    ...mapActions([
        'toggleRegisterForm',
        'toggleSignInOn',
    ]),
    handleRegister() {
      this.message = "";
      this.submitted = true;
      this.$validator.validate().then((isValid) => {
        if (isValid) {
          this.$store.dispatch("auth/register", this.user).then(
            (data) => {
              this.message = data.message;
              this.successful = true;
            },
            (error) => {
              this.message =
                (error.response && error.response.data) ||
                error.message ||
                error.toString();
              this.successful = false;
            }
          );
        }
      });
    },
    resetForm() {
      this.form = Object.assign({}, this.defaultForm);
      this.$refs.form.reset();
    },
    initShowForm () {
      return this.$store.dispatch('toggleSignInOn', true), this.$store.dispatch('toggleRegisterForm', false)
    },
    handleCancelled () {
        return this.resetForm(), this.initShowForm()
    }
  },
};
</script>

<style scoped lang="scss">
.theme--dark.v-list {
  background-color: #696975;
}
</style>