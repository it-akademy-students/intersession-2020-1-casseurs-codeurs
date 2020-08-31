<template>
  <div>
    <!-- nav drawer -->
    <v-navigation-drawer app v-model="drawer" disable-resize-watcher>
      <v-list>
        <v-list-group class="colorSecondary--text">
          <template v-slot:activator>
            <v-list-item-content>
              <v-list-item-title class="colorSecondary--text">Account</v-list-item-title>
            </v-list-item-content>
          </template>

          <v-list-item
            link
            v-if="$auth.check()"
            href="#user-profile"
            @click.stop="drawer = !drawer"
            @click="showProfile"
          >
            <v-list-item-content class="colorTertiaryLight--text">
              <v-list-item-title>Profile</v-list-item-title>
            </v-list-item-content>
          </v-list-item>

          <v-list-item
            link
            v-if="!$auth.check()"
            @click="showLoginForm"
            href="/#login-form"
            @click.stop="drawer = !drawer"
          >
            <v-list-item-content class="colorTertiaryLight--text">
              <v-list-item-title>Sign in</v-list-item-title>
            </v-list-item-content>
          </v-list-item>

          <v-list-item
            link
            v-if="!$auth.check()"
            @click="showRegisterForm"
            href="/#register-form"
            @click.stop="drawer = !drawer"
          >
            <v-list-item-content class="colorTertiaryLight--text">
              <v-list-item-title>Sign up</v-list-item-title>
            </v-list-item-content>
          </v-list-item>

          <v-list-item
            link
            v-if="$auth.check()"
            @click="handleLogout"
            href="/"
            @click.stop="drawer = !drawer"
          >
            <v-list-item-content class="colorTertiaryLight--text">
              <v-list-item-title>Logout</v-list-item-title>
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
    <v-app-bar app>
      <v-hover>
        <v-app-bar-nav-icon
          @click.stop="drawer = !drawer"
          slot-scope="{ hover }"
          :class="
            `${
                hover
                  ? 'colorTertiary--text hidden-md-and-up'
                  : 'colorSecondary--text hidden-md-and-up'
            }`
          "
        ></v-app-bar-nav-icon>
      </v-hover>
      <v-spacer class="hidden-md-and-up"></v-spacer>
      <v-img
        class="mx-1"
        src="../../img/swapp_image_logo.svg"
        max-height="100"
        max-width="100"
        contain
        alt="logo"
      ></v-img>
      <v-toolbar-title
        class="colorSecondary--text display-1"
        style="font-family: 'Open Sans', sans-serif;"
      >
        {{ appName }}
        <span class="hidden-sm-and-down">{{ appSlogan }}</span>
      </v-toolbar-title>
      <v-spacer class="hidden-sm-and-down"></v-spacer>

      <v-list class="hidden-sm-and-down colorPrimary">
        <v-list-item-group class="d-flex" v-model="navItems">
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
                <v-list-item-title v-text="navItems[1].title"></v-list-item-title>
              </v-list-item-content>
            </v-hover>
          </v-list-item>

          <v-list-item :href="navItems[0].link" link target="_blank">
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
                <v-list-item-title v-text="navItems[0].title"></v-list-item-title>
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
                        <v-list-item-title>Profile</v-list-item-title>
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
                        <v-list-item-title>Sign in</v-list-item-title>
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
                        <v-list-item-title>Sign up</v-list-item-title>
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
                        @click="handleLogout"
                      >
                        <v-list-item-title>Logout</v-list-item-title>
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
import NavMenu from "@/js/components/NavMenu";
import store from "../stores/store";
import { mapGetters, mapState, mapActions } from "vuex";

export default {
  name: "NavMenu",
  store: store,
  data: () => ({
    drawer: false,
    appName: "SWAPP ",
    appSlogan: "- Security Scan for Web App",
    navItems: [
      {
        title: "GitHub",
        link:
          "https://github.com/it-akademy-students/intersession-2020-1-casseurs-codeurs",
      },
      {
        title: "Contact",
        // link: "/contact"
      },
    ],
  }),
  methods: {
    ...mapActions([
      "toggleRegisterForm",
      "toggleLoginForm",
      "toggleSignInOn",
      "toggleUserProfile",
      "toggleLoggedIn",
    ]),
    showModalContact: () => {
      store.commit("showContact");
    },
    showLoginForm() {
      return (
        this.$store.dispatch("toggleLoginForm", true),
        this.$store.dispatch("toggleSignInOn", false),
        this.$store.dispatch("toggleRegisterForm", false),
        this.$store.dispatch("toggleLoggedIn", false),
        this.$store.dispatch("toggleUserProfile", false)
      );
      // return this.$router.push('/login')
    },
    showRegisterForm() {
      return (
        this.$store.dispatch("toggleLoginForm", false),
        this.$store.dispatch("toggleSignInOn", false),
        this.$store.dispatch("toggleRegisterForm", true),
        this.$store.dispatch("toggleLoggedIn", false),
        this.$store.dispatch("toggleUserProfile", false)
      );
      // return this.$router.push('/register')
    },
    showProfile() {
      return (
        this.$store.dispatch("toggleLoginForm", false),
        this.$store.dispatch("toggleSignInOn", false),
        this.$store.dispatch("toggleRegisterForm", false),
        this.$store.dispatch("toggleLoggedIn", false),
        this.$store.dispatch("toggleUserProfile", true)
      );
    },
    showLoggedIn() {
      return (
        this.$store.dispatch("toggleLoginForm", false),
        this.$store.dispatch("toggleSignInOn", false),
        this.$store.dispatch("toggleRegisterForm", false),
        this.$store.dispatch("toggleLoggedIn", true),
        this.$store.dispatch("toggleUserProfile", false)
      );
    },
    initShowForm() {
      return (
        this.$store.dispatch("toggleLoginForm", false),
        this.$store.dispatch("toggleSignInOn", true),
        this.$store.dispatch("toggleRegisterForm", false),
        this.$store.dispatch("toggleLoggedIn", false),
        this.$store.dispatch("toggleUserProfile", false)
      );
    },
    handleLogout() {
      return this.initShowForm();
      // return this.$router.push("/login");
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
