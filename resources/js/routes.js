import Vue from "vue";
import VueRouter from "vue-router";
import goTo from "vuetify/es5/services/goto";

import Home from "@/js/pages/Home";
import PageNotFound from "@/js/pages/PageNotFound";
import UserProfile from "@/js/components/UserProfile";
import RegisterForm from "@/js/components/RegisterForm";
import LoginForm from "@/js/components/LoginForm";
import Logged from "@/js/components/Logged";
import EditProfileForm from "@/js/components/EditProfileForm";
import Dashboard from "@/js/components/Dashboard";
import ResetPasswordForm from "@/js/pages/ResetPasswordForm";

Vue.use(VueRouter);

const Route = new VueRouter({
    history: true,
    mode: "history",
    scrollBehavior: (to, from, savedPosition) => {
        let scrollTo = 0;

        if (to.hash) {
            scrollTo = to.hash;
        } else if (savedPosition) {
            scrollTo = savedPosition.y;
        }

        return goTo(scrollTo);
    },
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
                        },
                        {
                            path: ":id",
                            name: "user-dashboard",
                            component: Dashboard
                        }
                    ]
                }
            ]
        },
        // RESET USER PASSWORD
        { 
            path: '/reset-password', 
            name: 'reset-password', 
            component: Home, 
            meta: { 
              auth:false 
            } 
          },
          { 
            path: '/reset-password/:token', 
            name: 'reset-password-form', 
            component: ResetPasswordForm, 
            meta: { 
              auth:false 
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
        },
    ]
});

export default Route;
