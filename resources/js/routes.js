import Vue from "vue"
import VueRouter from "vue-router"

import Home from "@/js/components/Home"
import About from "@/js/components/About"

Vue.use(VueRouter)

const Route = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/",
            name: "home",
            component: Home
        },
        {
            path: "/about",
            name: "about",
            component: About
        }
    ]
})

export default Route