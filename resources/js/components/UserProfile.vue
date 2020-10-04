<template>
  <v-card flat color="colorPrimaryUltraLight" id="user-profile">
    <v-col cols="12">
      <v-row justify="end" class="pa-0 ma-0">
        <v-col cols="1">
          <v-icon @click="toggleShowLoggedInForms">mdi-close</v-icon>
        </v-col>
      </v-row>
      <v-row>
        <v-col cols="12">
          <h2 class="pa-2 text-center">
            {{ $tc("userProfile.title", 1) }}
            {{ this.$auth.user().name | capitalize }}:
          </h2>
        </v-col>
      </v-row>
    </v-col>

    <v-form ref="form" name="form">
      <v-container fluid>
        <v-row>
          <v-col cols="12">
            <v-text-field
              :value="this.$auth.user().name"
              type="text"
              name="username"
              :label="$tc('userProfile.form.labelName', 1)"
              readonly
              color="colorTertiaryLight"
            ></v-text-field>
          </v-col>
          <v-col cols="12">
            <v-text-field
              :value="this.$auth.user().email"
              type="email"
              name="email"
              :label="$tc('userProfile.form.labelEmail', 1)"
              readonly
              color="colorTertiaryLight"
            ></v-text-field>
          </v-col>
          <v-col cols="12">
            <v-text-field
              :value="this.$auth.user().job"
              type="text"
              :label="$tc('userProfile.form.labelJob', 1)"
              name="job"
              color="colorTertiaryLight"
              readonly
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
                >{{ $tc("userProfile.actions.delete", 1) }}</v-btn
              >
            </v-col>
            <v-col xs="6" md="auto">
              <v-btn
                text
                class="colorWarning--text"
                @click.prevent="handleEditProfile"
                >{{ $tc("userProfile.actions.edit", 1) }}</v-btn
              >
            </v-col>
            <v-col xs="12" md="auto">
              <v-btn
                text
                @click.prevent="handleLogout"
                class="colorTertiaryLight--text"
                >{{ $tc("userProfile.actions.logout", 1) }}</v-btn
              >
            </v-col>
          </v-row>
        </v-container>
      </v-card-actions>
    </v-form>
  </v-card>
</template>

<script>
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
    resetForm() {
      this.form = Object.assign({}, this.defaultForm);
    },
    initShowForm() {
      return this.$router.push({ name: "home" });
    },
    toggleShowLoggedInForms() {
      return this.$router.push({ name: "user" });
    },
    handleDeleteUser() {
      let url = `/auth/user/${this.$auth.user().id}`;
      this.$auth.logout();
      this.axios.delete(url);
      this.resetForm();
      this.initShowForm();
      return this.$router.push({ name: "home" });
    },
    handleEditProfile() {
      this.$route.path == "/user/account/edit"
        ? this.$vuetify.goTo("#edit-form")
        : this.$router.push("/#edit-form");
    },
    handleLogout() {
      this.$auth.logout().then(
        (succ) => {
          return (
            this.resetForm(),
            this.initShowForm(),
            this.$router.push({ name: "home" })
          );
        },
        (err) => {
          console.log({ err });
        }
      );
    },
  },
};
</script>
<style scoped lang="scss">
.theme--dark.v-list {
  background-color: #696975;
}
</style>