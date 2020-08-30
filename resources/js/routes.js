import Vue from "vue";
import VueRouter from "vue-router";

import Home from "@/js/pages/Home";
import PageNotFound from "@/js/pages/PageNotFound";
import UserProfile from "@/js/components/UserProfile";
import RegisterForm from "@/js/components/RegisterForm";
import LoginForm from "@/js/components/LoginForm";
import Logged from "@/js/components/Logged";
import EditProfileForm from "@/js/components/EditProfileForm";
import ContactForm from "@/js/components/ContactForm";

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
            },
            children: [
                {
                    path: "register",
                    name: "home-register",
                    component: RegisterForm,
                    meta: {
                        auth: false
                    }
                },
                {
                    path: "login",
                    name: "home-login",
                    component: LoginForm,
                    meta: {
                        auth: false
                    }
                },
                

                // USER ROUTES (only authenticated users)
                {
                    path: "user",
                    name: "user",
                    component: Logged,
                    meta: {
                        auth: true
                    },
                    children: [
                        {
                            path: "account",
                            name: "user-account",
                            component: UserProfile,
                            children: [
                                {
                                    path: "edit",
                                    name: "user-account-edit",
                                    component: EditProfileForm
                                }
                            ]
                        }
                    ]
                }
            ]
        },
        {
            path: "contact",
            name: "contact",
            component: ContactForm,
            meta: {
                auth: undefined
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
    ],
    scrollBehavior (to, from, savedPosition) {
        if (to.hash) {
          return {
            selector: to.hash
            , offset: { x: 0, y: 10 }
          }
        }
      }
});

export default Route;
