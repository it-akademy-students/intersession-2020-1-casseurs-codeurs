import "./bootstrap"
import Vue from "vue"
import vuetify from "@/js/plugins/vuetify"
import VueResource from "vue-resource"
import VeeValidate from 'vee-validate';
//Route information router
import Route from "@/js/routes.js"

//Component file
import App from "@/js/views/App"

// Store file
import store from "./stores/store"

Vue.use(VueResource)
Vue.use(VeeValidate);

Vue.http.options.root = "http://localhost:8000/api";

const app = new Vue({
    el: "#app",
    vuetify,
    store,
    router: Route,
    render: h => h(App)
})