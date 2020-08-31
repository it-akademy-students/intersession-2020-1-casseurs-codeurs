<template>
  <v-card flat color="colorPrimaryUltraLight" id="user-profile">
    <v-col cols="12">
      <v-row>
        <v-col cols="11">
          <h2
            class="pa-2 text-center"
          >{{ $tc("userProfile.title", 1) }} {{ this.$store.getters.getUser.name | capitalize }}:</h2>
        </v-col>
        <v-col cols="1">
          <v-icon @click="toggleShowLoggedInForms">mdi-close</v-icon>
        </v-col>
      </v-row>
    </v-col>

    <v-form ref="form" name="form">
      <v-container fluid>
        <v-row>
          <v-col cols="12">
            <v-text-field
              :value="this.$store.getters.getUser.id"
              type="text"
              name="id"
              label="id"
              class="d-none"
            ></v-text-field>
          </v-col>
          <v-col cols="12">
            <v-text-field
              :value="this.$store.getters.getUser.name"
              type="text"
              name="username"
              :label="$tc('userProfile.form.labelName', 1)"
              required
              color="colorTertiaryLight"
            ></v-text-field>
          </v-col>
          <v-col cols="12">
            <v-text-field
              :value="this.$store.getters.getUser.email"
              type="email"
              name="email"
              :label="$tc('userProfile.form.labelEmail', 1)"
              required
              color="colorTertiaryLight"
            ></v-text-field>
          </v-col>
          <v-col cols="12">
            <v-text-field
              :value="this.$store.getters.getUser.job"
              type="text"
              :label="$tc('userProfile.form.labelJob', 1)"
              name="job"
              color="colorTertiaryLight"
            ></v-text-field>
          </v-col>
        </v-row>
      </v-container>
      <v-card-actions>
        <v-container fluid>
          <v-row>
            <v-col xs="6" md="auto">
              <v-btn
                text
                @click.prevent="handleDeleteUser"
                class="colorDanger--text"
              >{{ $tc("userProfile.actions.delete", 1) }}</v-btn>
            </v-col>
            <v-col xs="6" md="auto">
              <v-btn
                text
                class="colorWarning--text"
                @click.prevent="updateProfil"
              >{{ $tc("userProfile.actions.edit", 1) }}</v-btn>
            </v-col>
            <v-col xs="12" md="auto">
              <v-btn
                text
                @click.prevent="handleLogout"
                class="colorTertiaryLight--text"
              >{{ $tc("userProfile.actions.logout", 1) }}</v-btn>
            </v-col>
          </v-row>
        </v-container>
      </v-card-actions>
    </v-form>
  </v-card>
</template>

<script>
import { mapGetters, mapState, mapActions } from "vuex";

export default {
  name: "UserProfile",
  data() {
    const defaultForm = Object.freeze({
      id: "",
      name: "",
      email: "",
      job: "",
    });
    return {
      defaultForm,
    };
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
    resetForm() {
      this.form = Object.assign({}, this.defaultForm);
      this.$refs.form.reset();
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
    toggleShowLoggedInForms() {
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
    handleLogout() {
      this.$auth.logout().then(
        (succ) => {
          console.log(`user check logout ${this.$auth.check()}`);
          return (
            this.resetForm(),
            this.initShowForm(),
            this.$store.dispatch("setUser", ""),
            this.$router.push({ name: "home" })
          );
        },
        (err) => {
          console.log({ err });
        }
      );
    },
    handleDeleteUser() {
      // handle delete with $auth
      this.$auth.logout();
      this.resetForm();
      this.initShowForm();
      this.$store.dispatch("setUser", "");
      return this.$router.push({ name: "home" });
    },
    handleEditProfile() {
      // handle edit redirect to edit profile form
      this.$store.dispatch("toggleLoginForm", false);
      this.$store.dispatch("toggleSignInOn", false);
      this.$store.dispatch("toggleRegisterForm", false);
      this.$store.dispatch("toggleLoggedIn", false);
      this.$store.dispatch("toggleUserProfile", false);
      this.$store.dispatch("toggleEditProfile", true);
      this.$router.push({ name: "user-account-edit" });
    },
    updateProfil() {
      var app = this;
      console.log(this.$auth.user().name)
      this.$auth
        .user({
          id: this.$store.getters.getUser.id,
          name: app.name,
          email: app.email,
          // password: app.password,
          // password_confirmation: app.password_confirmation,
          job: app.job,
        })
      console.log(this.$auth.user().name)
        // .then(
        //   (succ) => {
        //     console.log(succ.data.status);
        //     return (
        //       (app.success = true),
        //       (app.snackbar = true),
        //       this.$store.dispatch("setUser", succ.data.data),
        //       this.resetForm(),
        //       this.toggleShowUserProfile(),
        //       this.$router.push({ name: "user-account" })
        //     );
        //   },
        //   (err) => {
        //     console.log({ err });
        //     return (
        //       (app.snackbar = true),
        //       (app.success = false),
        //       console.log(err.response.data.status),
        //       console.log(err.response.data.errors),
        //       (app.has_error = true),
        //       (app.error = err.response.data.error),
        //       (app.errs = err.response.data.errors || {})
        //     );
        //   }
        // );
    },
  },
};
</script>

<style scoped lang="scss">
.theme--dark.v-list {
  background-color: #696975;
}
</style>