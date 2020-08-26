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

          <v-list-item v-for="(item, i) in AccountItems" :key="i" :to="item.link" link>
            <v-list-item-content class="colorTertiaryLight--text">
              <v-list-item-title>
                {{
                item.title
                }}
              </v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list-group>
      </v-list>
      <!-- 
            <v-list>
                <v-list-item-group v-model="navItems">
                    <v-list-item
                        v-for="(item, index) in navItems"
                        :key="index"
                        :href="item.link"
                        link
                    >
                        <v-hover>
                            <v-list-item-content
                                slot-scope="{ hover }"
                                :class="
                                    `${
                                        hover
                                            ? 'colorTertiary--text'
                                            : 'colorSecondary--text'
                                    }`
                                "
                            >
                                <v-list-item-title
                                    v-text="item.title"
                                ></v-list-item-title>
                            </v-list-item-content>
                        </v-hover>
                    </v-list-item>
                </v-list-item-group>
      </v-list>-->
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
             :class="
                `${
                    hover
                      ? 'colorTertiary--text'
                      : 'colorSecondary--text'
                }
                mt-4`
              "
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
          <!-- <v-list-item v-for="(item, index) in navItems" :key="index" :href="item.link" link>
            <v-hover>
              <v-list-item-content
                slot-scope="{ hover }"
                :class="`${hover? 'colorTertiary--text' : 'colorSecondary--text '}`"
              >
                <v-list-item-title v-text="item.title"></v-list-item-title>
              </v-list-item-content>
            </v-hover>
          </v-list-item>-->
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
                  <v-list-item v-for="(item, i) in AccountItems" :key="i" :to="item.link" link>
                    <v-hover>
                      <v-list-item-content
                        class="pr-3 colorPrimary"
                        slot-scope="{ hover }"
                        :class="
                          `${
                              hover
                                ? 'colorTertiary--text'
                                : 'colorSecondary--text '
                          }`
                        "
                      >
                        <v-list-item-title>
                          {{
                          item.title
                          }}
                        </v-list-item-title>
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
export default {
  name: "NavMenu",
  data: () => ({
    drawer: false,
    appName: "SWAPP ",
    appSlogan: "- Security Scan for Web App",
    navItems: [
      {
        title: "GitHub",
        link:
          "https://github.com/it-akademy-students/intersession-2020-1-casseurs-codeurs"
      },
      {
        title: "Contact"
        // link: "/contact"
      }
    ],
    AccountItems: [
      {
        title: "Profile",
        link: "/"
      },
      {
        title: "Sign up",
        link: "/"
      },
      {
        title: "Login",
        link: "/"
      },
      {
        title: "Logout",
        link: "/"
      }
    ]
  }),
  methods: {
    showModalContact: () => {
      store.commit("showContact");
    }
  }
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
