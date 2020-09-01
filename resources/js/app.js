import "./bootstrap";
import Vue from "vue";
import vuetify from "@/js/plugins/vuetify";
import VeeValidate from "vee-validate";
import "es6-promise/auto";

import axios from "axios";
import auth from "@websanova/vue-auth";
import VueAxios from "vue-axios";
import VueRouter from "vue-router";
import config from "@/auth";

//Route information router
import Route from "@/js/routes.js";
//Component file
import App from "@/js/views/App";
// Store file
import store from "./stores/store";
// i18n
import i18n from "../../src/i18n";

Vue.config.productionTip = false;
// Set Vue router
Vue.router = Route;
Vue.use(VueRouter);

// Set Vue globally
window.Vue = Vue;

axios.defaults.baseURL = `${process.env.MIX_APP_URL}/api/`;
Vue.use(VueAxios, axios);

// Set Vue authentication
Vue.use(auth, config);

Vue.use(VeeValidate);

Vue.filter("capitalize", function(value) {
    if (!value) return "";
    value = value.toString();
    return value.charAt(0).toUpperCase() + value.slice(1);
});


/**
 * Represents a book.
 * @constructor
 */
const app = new Vue({
    el: "#app",
    vuetify,
    store,
    router: Route,
    i18n,
    render: h => h(App)
}).$mount("#app");
