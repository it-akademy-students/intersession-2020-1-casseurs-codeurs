import "./bootstrap"
import Vue from "vue"
import vuetify from "@/js/plugins/vuetify"
import VueResource from "vue-resource"
import VeeValidate from 'vee-validate';
import 'es6-promise/auto'
import axios from 'axios'
import VueAuth from '@websanova/vue-auth'
import VueAxios from 'vue-axios'
import auth from '@/auth'

//Route information router
import Route from "@/js/routes.js"

//Component file
import App from "@/js/views/App"

// Store file
import store from "./stores/store"

// Set Vue globally
// window.Vue = Vue
// Set Vue authentication
Vue.use(VueAxios, axios)
axios.defaults.baseURL = `${process.env.MIX_APP_URL}/api/v1`
Vue.use(VueAuth, auth)

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

