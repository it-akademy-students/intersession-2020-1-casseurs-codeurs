<template>
  <div>
    <!-- nav drawer -->
    <v-navigation-drawer app v-model="drawer" disable-resize-watcher>
      <v-list>
        <v-list-group class="colorSecondary--text">
          <template v-slot:activator>
            <v-list-item-content>
              <v-list-item-title class="colorSecondary--text">{{ $tc("navMenu.links.account", 1) }}</v-list-item-title>
            </v-list-item-content>
          </template>
          <v-list-item
            v-if="$auth.check()"
            link
            @click.stop="drawer = !drawer"
            @click="showProfile"
          >
            <v-list-item-content class="colorTertiaryLight--text">
              <v-list-item-title>{{ $tc("navMenu.links.profile", 1) }}</v-list-item-title>
            </v-list-item-content>
          </v-list-item>

          <v-list-item
            v-if="!$auth.check()"
            link
            @click="showLoginForm"
            @click.stop="drawer = !drawer"
          >
            <v-list-item-content class="colorTertiaryLight--text">
              <v-list-item-title>{{ $tc("navMenu.links.signIn", 1) }}</v-list-item-title>
            </v-list-item-content>
          </v-list-item>

          <v-list-item
            v-if="!$auth.check()"
            link
            @click="showRegisterForm"
            @click.stop="drawer = !drawer"
          >
            <v-list-item-content class="colorTertiaryLight--text">
              <v-list-item-title>{{ $tc("navMenu.links.signUp", 1) }}</v-list-item-title>
            </v-list-item-content>
          </v-list-item>

          <v-list-item
            v-if="$auth.check()"
            link
            @click="handleLogout"
            @click.stop="drawer = !drawer"
          >
            <v-list-item-content class="colorTertiaryLight--text">
              <v-list-item-title>{{ $tc("navMenu.links.logout", 1) }}</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list-group>
      </v-list>

      <v-hover>
        <div
          slot-scope="{ hover }"
          :class="
            `${
                hover
                  ? 'colorTertiary--text'
                  : 'colorSecondary--text'
            }
            pl-4
            contact
              `                   
          "
          @click="showModalContact"
        >Contact</div>
      </v-hover>
      <v-hover>
        <div
          slot-scope="{ hover }"
          :class="
            `${
                hover
                  ? 'colorTertiary--text'
                  : 'colorSecondary--text'
            }
            pl-4
            mt-4`
          "
        >
          <a
            target="_blank"
            href="https://github.com/it-akademy-students/intersession-2020-1-casseurs-codeurs"
            :class="`${hover ? 'colorTertiary--text' : 'colorSecondary--text'} mt-4`"
          >Github</a>
        </div>
      </v-hover>
    </v-navigation-drawer>
    <!-- navbar -->
    <v-app-bar app height="80rem">
      <v-app-bar-nav-icon
        @click.stop="drawer = !drawer"
        class="colorSecondary--text hidden-md-and-up"
      ></v-app-bar-nav-icon>
      <v-spacer class="hidden-md-and-up"></v-spacer>
      <v-img
        class="mx-1"
        src="../../img/swapp_image_logo.svg"
        :max-height="{'50': $vuetify.breakpoint.smAndDown, '100': $vuetify.breakpoint.mdAndUp}"
        :max-width="{'50': $vuetify.breakpoint.smAndDown, '100': $vuetify.breakpoint.mdAndUp}"
        contain
        alt="logo"
      ></v-img>
      <v-toolbar-title
        :class="{'subtitle-2 secondary--text': $vuetify.breakpoint.smAndDown, 'display-1 secondary--text': $vuetify.breakpoint.mdAndUp}"
        style="font-family: 'Open Sans', sans-serif;"
      >
        {{ $tc("navMenu.appName", 1) }}
        <span
          class="hidden-sm-and-down text-wrap"
        >{{ $tc("navMenu.appSlogan", 1) }}</span>
      </v-toolbar-title>
      <v-spacer></v-spacer>

      <!-- language switcher -->
      <lang-switcher />

      <v-list class="hidden-sm-and-down colorPrimary">
        <v-list-item-group class="d-flex">
          <v-list-item v-on:click="showModalContact">
            <v-hover>
              <v-list-item-content
                slot-scope="{ hover }"
                :class="
                  `${
                      hover
                        ? 'colorTertiary--text'
                        : 'colorSecondary--text '
                  }`
                "
              >
                <v-list-item-title>Contact</v-list-item-title>
              </v-list-item-content>
            </v-hover>
          </v-list-item>

          <v-list-item
            href="https://github.com/it-akademy-students/intersession-2020-1-casseurs-codeurs"
            link
            target="_blank"
          >
            <v-hover>
              <v-list-item-content
                slot-scope="{ hover }"
                :class="
                  `${
                      hover
                        ? 'colorTertiary--text'
                        : 'colorSecondary--text '
                  }`
                "
              >
                <v-list-item-title>GitHub</v-list-item-title>
              </v-list-item-content>
            </v-hover>
          </v-list-item>

          <v-list-item>
            <v-list-item-content>
              <v-menu
                bottom
                offset-y
                transition="scale-transition"
                origin="center center"
                rounded="xs"
              >
                <template v-slot:activator="{ on, attrs }">
                  <v-btn icon small v-bind="attrs" v-on="on" class="mr-1">
                    <v-hover>
                      <v-icon
                        size="20"
                        slot-scope="{ hover }"
                        :class="
                          `${
                              hover
                                ? 'colorTertiary--text'
                                : 'colorSecondary--text '
                          }`
                        "
                      >mdi-account</v-icon>
                    </v-hover>
                  </v-btn>
                </template>
                <v-list class="py-0 colorPrimary">
                  <v-list-item link v-if="$auth.check()">
                    <v-hover>
                      <v-list-item-content
                        class="pr-3 colorPrimary"
                        slot-scope="{ hover }"
                        :class="
                          `${hover? 'colorTertiary--text': 'colorSecondary--text '}`"
                        @click="showProfile"
                      >
                        <v-list-item-title>{{ $tc("navMenu.links.profile", 1) }}</v-list-item-title>
                      </v-list-item-content>
                    </v-hover>
                  </v-list-item>

                  <v-list-item link v-if="!$auth.check()">
                    <v-hover>
                      <v-list-item-content
                        class="pr-3 colorPrimary"
                        slot-scope="{ hover }"
                        :class="
                          `${hover? 'colorTertiary--text': 'colorSecondary--text '}`"
                        @click="showLoginForm"
                      >
                        <v-list-item-title>{{ $tc("navMenu.links.signIn", 1) }}</v-list-item-title>
                      </v-list-item-content>
                    </v-hover>
                  </v-list-item>

                  <v-list-item link v-if="!$auth.check()">
                    <v-hover>
                      <v-list-item-content
                        class="pr-3 colorPrimary"
                        slot-scope="{ hover }"
                        :class="
                          `${hover? 'colorTertiary--text': 'colorSecondary--text '}`"
                        @click="showRegisterForm"
                      >
                        <v-list-item-title>{{ $tc("navMenu.links.signUp", 1) }}</v-list-item-title>
                      </v-list-item-content>
                    </v-hover>
                  </v-list-item>

                  <v-list-item link v-if="$auth.check()">
                    <v-hover>
                      <v-list-item-content
                        class="pr-3 colorPrimary"
                        slot-scope="{ hover }"
                        :class="
                          `${hover? 'colorTertiary--text': 'colorSecondary--text '}`"
                        @click.prevent="handleLogout"
                      >
                        <v-list-item-title>{{ $tc("navMenu.links.logout", 1) }}</v-list-item-title>
                      </v-list-item-content>
                    </v-hover>
                  </v-list-item>
                </v-list>
              </v-menu>
            </v-list-item-content>
          </v-list-item>
        </v-list-item-group>
      </v-list>
    </v-app-bar>
  </div>
</template>

<script>
import LangSwitcher from "@/js/components/LangSwitcher";
import store from "../stores/store";
import { mapGetters, mapState, mapActions } from "vuex";

export default {
  name: "NavMenu",
  store: store,
  components: { LangSwitcher },
  data: () => ({
    drawer: false,
  }),
  methods: {
    ...mapActions([
      "toggleRegisterForm",
      "toggleLoginForm",
      "toggleSignInOn",
      "toggleUserProfile",
      "toggleLoggedIn",
      "toggleEditProfile",
    ]),

    showModalContact: () => {
      store.commit("showContact");
    },
    showLoginForm() {
      let destination;
      if (this.$route.path == "/login") {
        destination = this.$vuetify.goTo("#login-form");
      } else {
        destination = this.$router.push("/#login-form");
      }
      return (
        this.$store.dispatch("toggleLoginForm", true),
        this.$store.dispatch("toggleSignInOn", false),
        this.$store.dispatch("toggleRegisterForm", false),
        this.$store.dispatch("toggleLoggedIn", false),
        this.$store.dispatch("toggleUserProfile", false),
        this.$store.dispatch("toggleEditProfile", false),
        destination
      );
    },
    showRegisterForm() {
      let destination;
      if (this.$route.path == "/register") {
        destination = this.$vuetify.goTo("#register-form");
      } else {
        destination = this.$router.push("/#register-form");
      }
      return (
        this.$store.dispatch("toggleLoginForm", false),
        this.$store.dispatch("toggleSignInOn", false),
        this.$store.dispatch("toggleRegisterForm", true),
        this.$store.dispatch("toggleLoggedIn", false),
        this.$store.dispatch("toggleUserProfile", false),
        this.$store.dispatch("toggleEditProfile", false),
        destination
      );
    },
    showProfile() {
      let destination;
      if (this.$route.path == "/user/account") {
        destination = this.$vuetify.goTo("#user-profile");
      } else {
        destination = this.$router.push("/#user-profile");
      }
      return (
        this.$store.dispatch("toggleLoginForm", false),
        this.$store.dispatch("toggleSignInOn", false),
        this.$store.dispatch("toggleRegisterForm", false),
        this.$store.dispatch("toggleLoggedIn", false),
        this.$store.dispatch("toggleUserProfile", true),
        this.$store.dispatch("toggleEditProfile", false),
        destination
      );
    },
    showLoggedIn() {
      let destination;
      if (this.$route.path == "/user") {
        destination = this.$vuetify.goTo("#user-logged");
      } else {
        destination = this.$router.push("/#user-logged");
      }
      return (
        this.$store.dispatch("toggleLoginForm", false),
        this.$store.dispatch("toggleSignInOn", false),
        this.$store.dispatch("toggleRegisterForm", false),
        this.$store.dispatch("toggleLoggedIn", true),
        this.$store.dispatch("toggleUserProfile", false),
        this.$store.dispatch("toggleEditProfile", false),
        destination
      );
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
    handleLogout() {
      this.$auth.logout().then(
        (succ) => {
          return this.initShowForm(), this.$store.dispatch("setUser", "");
        },
        (err) => {
          console.log({ err });
        }
      );
    },
  },
};
</script>

<style lang="scss" scoped>
.v-btn:before,
.v-list-item:before,
.theme--dark.v-list-item--active:before,
.theme--dark.v-list-item--active:hover:before,
.theme--dark.v-list-item:focus:before {
  display: none;
}

.v-list-item:after,
.theme--dark.v-list-item--active:after,
.theme--dark.v-list-item--active:hover:after,
.theme--dark.v-list-item:focus:after {
  display: none;
}

a {
  text-decoration: none;
}

.contact {
  cursor: pointer;
}
</style>
