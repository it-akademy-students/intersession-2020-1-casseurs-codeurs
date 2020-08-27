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
        },
        {
            path: "/register",
            name: "register",
            component: RegisterForm,
        },
        {
            path: "/login",
            name: "login",
            component: LoginForm,
        },
        // USER ROUTES
        {
            path: "/profile",
            name: "profile",
            component: UserProfile,
        },
        // 404 ROUTE
        {
            path: "*",
            name: "404",
            component: PageNotFound,
        }
    ]
});


export default Route;
