import "./bootstrap"
import Vue from "vue"
import vuetify from "@/js/plugins/vuetify"

//Route information router
import Route from "@/js/routes.js"

//Component file
import App from "@/js/views/App"

const app = new Vue({
    el: "#app",
    vuetify,
    router: Route,
    render: h=> h(App)
})