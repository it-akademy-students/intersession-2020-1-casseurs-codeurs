// import Vue from "vue"
// import Vuetify, {
//     VApp,
//     VAppBar,
//     VNavigationDrawer,
//     VToolbar,
//     VContainer,
//     VContent
// } from "vuetify/lib"

// Vue.use(Vuetify, {
//     components: {
//         VApp,
//         VAppBar,
//         VNavigationDrawer,
//         VToolbar,
//         VContainer,
//         VContent
//     },
// })

// const opts = {}

// export default new Vuetify(opts)

// src/plugins/vuetify.js

import Vue from "vue";
import Vuetify from "vuetify";
import "vuetify/dist/vuetify.min.css";

Vue.use(Vuetify);

const opts = new Vuetify({
    theme: {
        options: {
            customProperties: true,
          },
        themes: {
            dark: {
                colorPrimaryLight: "#3a3a3f",
                colorPrimary: "#27272c",
                colorPrimaryDark: "#212125",
                colorPrimaryUltraLight: "#696975",

                colorSecondary: "#62cb5c",
                colorSecondaryLight: "#9ade96",

                colorTertiary: "#967dff",
                colorTertiaryLight: "#ab97ff",
                colorTertiaryDark: "#886add",

                white: "#fff",
                mostlyWhite: "#fbfbfb",
                black: "#000",
                colorGreyLight: "#B8B8BF",
                colorGrey: "#868693",
                colorGreyDark: "#565660",
                colorWarning: "#ffa500",
                colorDanger: "#ff6347",

                primary: "#27272c",
                secondary: "#62cb5c",
                accent: "#FF4081",
                error: "#ff6347",
                info: "#967dff",
                success: "#9ade96",
                warning: "#ffa500"
            }
        }
    }
});

export default new Vuetify(opts);

// src/plugins/vuetify.js si on utlise vuetify loader

// import Vue from 'vue'
// import Vuetify from 'vuetify/lib'

// Vue.use(Vuetify)

// const opts = {}

// export default new Vuetify(opts)
