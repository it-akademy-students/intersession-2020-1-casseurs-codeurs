<template>
  <div>
    <!-- nav drawer -->
    <v-navigation-drawer app v-model="drawer" dark disable-resize-watcher>
      <v-list>
        <v-list-item-group v-model="navItems">
          <v-list-item v-for="(item, index) in navItems" :key="index">
            <v-hover>
              <v-list-item-content
                slot-scope="{ hover }"
                :class="`${hover? 'colorTertiary--text': 'colorSecondary--text'}`"
              >
                <v-list-item-title v-text="item.title"></v-list-item-title>
              </v-list-item-content>
            </v-hover>
          </v-list-item>
        </v-list-item-group>
      </v-list>
    </v-navigation-drawer>
    <!-- header and navbar -->
    <v-app-bar app>
      <v-hover>
        <v-app-bar-nav-icon
          @click.stop="drawer = !drawer"
          slot-scope="{ hover }"
          :class="`${hover? 'colorTertiary--text hidden-md-and-up': 'colorSecondary--text hidden-md-and-up'}`"
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
          <v-list-item v-for="(item, index) in navItems" :key="index">
            <v-hover>
              <v-list-item-content
                slot-scope="{ hover }"
                :class="`${hover? 'colorTertiary--text' : 'colorSecondary--text '}`"
              >
                <v-list-item-title v-text="item.title"></v-list-item-title>
              </v-list-item-content>
            </v-hover>
          </v-list-item>
        </v-list-item-group>
      </v-list>
    </v-app-bar>
  </div>
</template>

<script>
import NavMenu from "@/js/components/NavMenu";
export default {
  name: "HeaderApp",
  data: () => ({
    drawer: false,
    appName: "SWAPP ",
    appSlogan: "- Security Scan for Web App",
    navItems: [{ title: "Account" }, { title: "GitHub" }, { title: "Contact" }],
  }),
};
</script>
