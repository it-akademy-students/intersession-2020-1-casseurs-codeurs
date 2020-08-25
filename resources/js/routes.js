import Vue from "vue";
import VueRouter from "vue-router";

import Home from "@/js/pages/Home";
import Contact from "@/js/pages/Contact";
import PageNotFound from "@/js/pages/PageNotFound"

Vue.use(VueRouter);

const Route = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/",
            name: "home",
            component: Home
        },
        { 
            path: "*", 
            name: "404",
            component: PageNotFound 
        }
    ]
});

export default Route;
