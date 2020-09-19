<template>
  <v-container fluid class="py-0">
    <v-banner v-if="!$auth.check()" class="text-center">
      {{ $tc("logged.stats.found", 1) }}
      <span class="colorTertiary--text">{{ errorsFound }}</span>
      {{ $tc("logged.stats.errorsFound", 1) }},
      <span
        class="colorTertiary--text"
      >{{ securityFails }}</span>
      {{ $tc("logged.stats.securityFails", 1) }}
      <span
        class="colorTertiary--text"
      >{{ scannedFiles }}</span>
      {{ $tc("logged.stats.scannedFiles", 1) }}
      <span
        class="colorTertiary--text"
      >{{ repositoryScanned }}</span>
      {{ $tc("logged.stats.migrationAssistance", 1) }}
      <span
        class="colorTertiary--text"
      >{{ migrationAssistance }}</span>
      {{ $tc("logged.stats.project", 1) }}
    </v-banner>
    <v-card flat class="pa-3" color="colorPrimaryLight">
      <v-row align-content="space-around" justify="center">
        <v-col cols="12" lg="7">
          <v-card flat color="colorPrimaryLight pa-3">
            <main-welcome-donate />
            <contact />
          </v-card>
        </v-col>
        <v-col cols="12" lg="1">
          <v-layout justify-center>
            <v-divider class="ma-3 mt-5 divider-y hidden-md-and-down" inset vertical></v-divider>
          </v-layout>
        </v-col>
        <v-col cols="12" lg="4">
          <v-card color="colorPrimaryUltraLight" class="pa-5 mt-5">
            <sign-in-on v-if="this.$store.getters.isShowSignInOn && !this.$auth.check()" />
            <login-form v-if="this.$store.getters.isShowLoginForm && !this.$auth.check()" />
            <register-form v-if="this.$store.getters.isShowRegisterForm && !this.$auth.check()" />
            <user-profile v-if="this.$store.getters.isShowUserProfile && this.$auth.check()" />
            <logged v-if="this.$store.getters.isShowLoggedIn && this.$auth.check()" />
            <edit-profile-form v-if="this.$store.getters.isShowEditProfile && this.$auth.check()" />
          </v-card>
        </v-col>
      </v-row>
    </v-card>

    <v-dialog v-model="dialog" persistent max-width="290" transition="fade-transition">
      <v-card color="colorPrimaryLight">
        <v-card-title class="headline secondary--text">Cookies:</v-card-title>
        <v-card-text>{{ $tc('cookies.text', 1) }}</v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="secondary"
            text
            @click="dialog = false"
          >{{ $tc('cookies.actions.disagree', 1) }}</v-btn>
          <v-btn
            color="secondary"
            text
            @click="dialog = false"
          >{{ $tc('cookies.actions.agree', 1) }}</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-container>
</template>

<script>
import MainWelcomeDonate from "@/js/components/MainWelcomeDonate";
import SignInOn from "@/js/components/SignInOn";
import LoginForm from "@/js/components/LoginForm";
import RegisterForm from "@/js/components/RegisterForm";
import UserProfile from "@/js/components/UserProfile";
import Logged from "@/js/components/Logged";
import EditProfileForm from "@/js/components/EditProfileForm";
import Contact from "@/js/pages/Contact";

export default {
  name: "MainApp",
  components: {
    MainWelcomeDonate,
    SignInOn,
    LoginForm,
    RegisterForm,
    UserProfile,
    Logged,
    EditProfileForm,
    Contact,
  },
  beforeMount() {
    this.getStats();
    this.initCookies();
  },
  data: () => ({
    dialog: false,
    errorsFound: "",
    securityFails: "",
    scannedFiles: "",
    repositoryScanned: "",
    migrationAssistance: "",
  }),
  methods: {
    getStats() {
      let url = `/statistics`;
      axios
        .get(url)
        .then((res) => {
          this.errorsFound = res.data.data.errorsFound;
          this.securityFails = res.data.data.securityFails;
          this.scannedFiles = res.data.data.scannedFiles;
          this.repositoryScanned = res.data.data.repositoryScanned;
          this.migrationAssistance = res.data.data.migrationAssistance;
        })
        .catch((err) => {
          console.log({ err });
        });
    },
    initCookies() {
      if (!this.$auth.check()) {
        setTimeout(() => {
          this.dialog = true;
        }, 3000);
      }
    },
  },
};
</script>

<style scoped lang="scss">
.divider-y {
  min-height: 70vh;
  width: 0.2rem;
  height: calc(100% - 2rem);
  box-sizing: border-box;
  background-color: #62cb5c;
  transform: scale(1.02);
}
</style>
