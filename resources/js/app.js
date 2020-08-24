import "./bootstrap"
import Vue from "vue"
import vuetify from "@/js/plugins/vuetify"
import VueResource from "vue-resource"
//Route information router
import Route from "@/js/routes.js"

//Component file
import App from "@/js/views/App"

// Store file
import store from "./stores/store"

Vue.use(VueResource)

const app = new Vue({
    el: "#app",
    vuetify,
    store,
    router: Route,
    render: h => h(App)
})