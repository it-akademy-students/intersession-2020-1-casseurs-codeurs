<template>
    <v-container fluid>
        <v-card flat class="pa-3" color="colorPrimaryLight">
            <v-row align-content="space-around" justify="center">
                <v-col cols="12" lg="7">
                    <v-card flat color="colorPrimaryLight pa-3">
                        <main-welcome-donate />
                        <contact />
                    </v-card>
                </v-col>
                <v-col cols="12" lg="1">
                    <v-layout justify-center>
                        <v-divider
                            class="ma-3 mt-5 divider-y hidden-md-and-down"
                            inset
                            vertical
                        ></v-divider>
                    </v-layout>
                </v-col>
                <v-col cols="12" lg="4">
                    <v-card color="colorPrimaryUltraLight" class="pa-5 mt-5">
                        <sign-in-on />
                        <!-- <login-form /> -->
                        <!-- <registrar-form /> -->
                        <!-- <user-profile /> -->
                        <!-- <logged /> -->
                    </v-card>
                </v-col>
            </v-row>
        </v-card>
    </v-container>
</template>

<script>
import MainWelcomeDonate from "@/js/components/MainWelcomeDonate";
import SignInOn from "@/js/components/SignInOn";
import LoginForm from "@/js/components/LoginForm";
import RegistrarForm from "@/js/components/RegistrarForm";
import UserProfile from "@/js/components/UserProfile";
import Logged from "@/js/components/Logged";
import Contact from "@/js/pages/Contact";

export default {
    name: "MainApp",
    components: {
        MainWelcomeDonate,
        SignInOn,
        LoginForm,
        RegistrarForm,
        UserProfile,
        Logged,
        Contact
    }
};
</script>

<style scoped lang="scss">
.divider-y {
    min-height: 70vh;
    width: 0.2rem;
    height: calc(100% - 2rem);
    box-sizing: border-box;
    // background-color: #967dff;
    background-color: #62cb5c;
    transform: scale(1.02);
}
</style>
