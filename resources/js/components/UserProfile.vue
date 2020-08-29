<template>
  <v-card flat color="colorPrimaryUltraLight" id="user-profile">
    <v-col cols="12">
      <v-row>
        <v-col cols="11">
          <h2 class="pa-2 text-center">Your Profile {{ this.$store.getters.getUser.name | capitalize }}:</h2>
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
              label="Username"
              required
              color="colorTertiaryLight"
            ></v-text-field>
          </v-col>
          <v-col cols="12">
            <v-text-field
              :value="this.$store.getters.getUser.email"
              type="email"
              name="email"
              label="Email"
              required
              color="colorTertiaryLight"
            ></v-text-field>
          </v-col>
          <v-col cols="12">
            <v-text-field
              :value="this.$store.getters.getUser.job"
              type="text"
              label="Your Job"
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
              <v-btn text @click.prevent="handleDeleteUser" class="colorDanger--text">Delete Account</v-btn>
            </v-col>
            <v-col xs="6" md="auto">
              <v-btn text class="colorWarning--text" @click.prevent="handleEditProfile">Edit Profile</v-btn>
            </v-col>
            <v-col xs="12" md="auto">
              <v-btn text @click.prevent="handleLogout" class="colorTertiaryLight--text">Logout</v-btn>
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
    submit() {
      this.snackbar = true;
      this.resetForm();
    },
    initShowForm() {
      return (
        this.$store.dispatch("toggleLoginForm", false),
        this.$store.dispatch("toggleSignInOn", true),
        this.$store.dispatch("toggleRegisterForm", false),
        this.$store.dispatch("toggleLoggedIn", false),
        this.$store.dispatch("toggleUserProfile", false),
        this.$store.dispatch("toggleEditProfile", false)
      );
    },
    toggleShowLoggedInForms() {
      return (
        this.$store.dispatch("toggleLoginForm", false),
        this.$store.dispatch("toggleSignInOn", false),
        this.$store.dispatch("toggleRegisterForm", false),
        this.$store.dispatch("toggleLoggedIn", true),
        this.$store.dispatch("toggleUserProfile", false),
        this.$store.dispatch("toggleEditProfile", false)
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
            this.$router.push({ name: "logout" })
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
      const redirectTo = "logout";
      return this.$router.push({ name: redirectTo });
    },
    handleEditProfile() {
      // handle edit redirect to edit profile form
      this.$store.dispatch("toggleLoginForm", false);
      this.$store.dispatch("toggleSignInOn", false);
      this.$store.dispatch("toggleRegisterForm", false);
      this.$store.dispatch("toggleLoggedIn", false);
      this.$store.dispatch("toggleUserProfile", false);
      this.$store.dispatch("toggleEditProfile", true);
    },
  },
};
</script>

<style scoped lang="scss">
.theme--dark.v-list {
  background-color: #696975;
}
</style>