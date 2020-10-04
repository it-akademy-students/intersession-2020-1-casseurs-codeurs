<template>
  <v-card flat color="colorPrimaryUltraLight" id="edit-form">
    <v-col cols="12">
      <v-col cols="12">
        <v-row justify="end" class="pa-0 ma-0">
          <v-col cols="1">
            <v-icon @click="handleCancelled">mdi-close</v-icon>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12">
            <h2 class="pa-2 text-center">
              {{ $tc("editProfile.title", 1) }}
              {{ this.$auth.user().name | capitalize }}:
            </h2>
          </v-col>
        </v-row>
      </v-col>
    </v-col>
    <v-form
      ref="form"
      name="form"
      @submit.prevent="handleUpdateProfil"
      method="POST"
    >
      <v-container fluid>
        <v-row>
          <v-col cols="12">
            <v-text-field
              v-model="name"
              type="text"
              :label="$tc('editProfile.form.labelName', 1)"
              required
              color="colorTertiaryLight"
            ></v-text-field>
          </v-col>
          <v-col cols="12">
            <v-text-field
              v-model="email"
              type="email"
              :label="$tc('editProfile.form.labelEmail', 1)"
              required
              color="colorTertiaryLight"
            ></v-text-field>
          </v-col>
          <v-col cols="12">
            <v-text-field
              v-model="job"
              type="text"
              :label="$tc('editProfile.form.labelJob', 1)"
              color="colorTertiaryLight"
            ></v-text-field>
          </v-col>
        </v-row>
      </v-container>
      <v-card-actions>
        <v-btn text @click="handleCancelled">{{
          $tc("editProfile.form.cancel", 1)
        }}</v-btn>
        <v-spacer></v-spacer>
        <v-btn text class="colorTertiaryLight--text" type="submit">{{
          $tc("editProfile.form.edit", 1)
        }}</v-btn>
      </v-card-actions>
      <!-- snackbar user feed-back -->
      <v-snackbar
        v-if="has_error && !success"
        v-model="snackbar"
        absolute
        top
        right
        color="error"
      >
        <span color="colorPrimary--text">{{
          $tc("editProfile.snackBar.error", 1)
        }}</span>
        <v-icon dark>mdi-alert-circle</v-icon>
      </v-snackbar>
    </v-form>
  </v-card>
</template>

<script>
export default {
  name: "EditProfileForm",
  data() {
    const defaultForm = Object.freeze({
      name: "",
      email: "",
      job: "",
    });
    return {
      name: "",
      email: "",
      job: "",
      defaultForm,
      snackbar: false,
      has_error: false,
      success: false,
    };
  },
  methods: {
    handleUpdateProfil() {
      const app = this;

      let url = `/auth/user/${this.$auth.user().id}`;
      let data = new FormData();
      if (app.name) {
        data.append("name", app.name);
      }
      if (app.email) {
        data.append("email", app.email);
      }
      if (app.job) {
        data.append("email", app.email);
      }
      let header = {
        headers: {
          Authorization: `bearer ${this.$auth.token()}`,
          "Content-Type": "application/x-www-form-urlencoded",
        },
      };
      this.axios
        .post(url, data, header)
        .then((res) => {
          this.$auth.user({
            name: res.data.data.name,
            email: res.data.data.email,
            job: res.data.data.job,
          });
          this.$auth
            .fetch()
            .then(this.resetForm(), this.toggleShowUserProfile());
        })
        .catch((err) => {
          app.success = false;
          app.has_error = true;
          app.snackbar = true;
        });
    },
    resetForm() {
      this.form = Object.assign({}, this.defaultForm);
    },
    toggleShowUserProfile() {
      this.$route.path == "/user/account"
        ? this.$vuetify.goTo("#user-profile")
        : this.$router.push("/#user-profile");
    },
    handleCancelled() {
      return this.resetForm(), this.toggleShowUserProfile();
    },
  },
};
</script>

<style scoped lang="scss">
.theme--dark.v-list {
  background-color: #696975;
}
</style>