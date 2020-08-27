import Vue from "vue";
import VueRouter from "vue-router";

import Home from "@/js/pages/Home";
import LoginForm from "@/js/components/LoginForm";
import RegisterForm from "@/js/components/RegisterForm";
import UserProfile from "@/js/components/UserProfile";
import PageNotFound from "@/js/pages/PageNotFound";

Vue.use(VueRouter);


const Route = new VueRouter({
    history: true,
    mode: "history",
    routes: [
        {
            path: "/",
            name: "home",
            component: Home,
            meta: {
                auth: undefined
            }
        },
        {
            path: "/register/",
            name: "register",
            component: Home,
            meta: {
                auth: false
              }
        },
        {
            path: "/login",
            name: "login",
            component: LoginForm,
            meta: {
                auth: false
              }
        },
        // USER ROUTES
        {
            path: "/profile",
            name: "profile",
            component: UserProfile,
            meta: {
                auth: true
            }
        },
        // 404 ROUTE
        {
            path: "*",
            name: "404",
            component: PageNotFound,
            meta: {
                auth: undefined
            }
        }
    ]
});


export default Route;
