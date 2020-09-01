import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        showModalContact: false,
        showLogin: false,
        showRegister: false,
        showSign: true,
        showLogged: false,
        showProfile: false,
        showEditProfile: false,
        user: "",
        userAuthenticated: false
    },

    getters: {
        isShowContact: state => {
            return state.showModalContact;
        },
        isShowLoginForm: state => {
            return state.showLogin;
        },
        isShowRegisterForm: state => {
            return state.showRegister;
        },
        isShowSignInOn: state => {
            return state.showSign;
        },
        isShowLoggedIn: state => {
            return state.showLogged;
        },
        isShowUserProfile: state => {
            return state.showProfile;
        },
        isShowEditProfile: state => {
            return state.showEditProfile;
        },
        getUser: state => {
            return state.user;
        },
        isAuthenticated: state => {
            return state.userAuthenticated;
        }
    },

    mutations: {
        showContact: state => {
            state.showModalContact = true;
        },
        hideContact: state => {
            state.showModalContact = false;
        },
        SHOW_LOGIN_FORM: (state, val) => {
            state.showLogin = val;
        },
        SHOW_REGISTER_FORM: (state, val) => {
            state.showRegister = val;
        },
        SHOW_SIGNIN_SIGNON: (state, val) => {
            state.showSign = val;
        },
        SHOW_LOGGEDIN: (state, val) => {
            state.showLogged = val;
        },
        SHOW_USER_PROFILE: (state, val) => {
            state.showProfile = val;
        },
        SHOW_EDIT_PROFILE: (state, val) => {
            state.showEditProfile = val;
        },
        SET_USER: (state, val) => {
            state.user = val;
        },
        SET_USER_AUTHENTICATED: (state, val) => {
            state.userAuthenticated = val;
        }
    },

    actions: {
        toggleLoginForm: (store, val) => {
            store.commit("SHOW_LOGIN_FORM", val);
        },
        toggleRegisterForm: (store, val) => {
            store.commit("SHOW_REGISTER_FORM", val);
        },
        toggleSignInOn: (store, val) => {
            store.commit("SHOW_SIGNIN_SIGNON", val);
        },
        toggleLoggedIn: (store, val) => {
            store.commit("SHOW_LOGGEDIN", val);
        },
        toggleUserProfile: (store, val) => {
            store.commit("SHOW_USER_PROFILE", val);
        },
        toggleEditProfile: (store, val) => {
            store.commit("SHOW_EDIT_PROFILE", val);
        },
        setUser: (store, val) => {
            store.commit("SET_USER", val);
        },
        setUserAuthenticated: (store, val) => {
            store.commit("SET_USER_AUTHENTICATED", val);
        }
    }
});

global.store = store;
export default store;
