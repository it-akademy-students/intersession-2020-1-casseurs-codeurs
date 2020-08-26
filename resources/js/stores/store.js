import Vue from "vue"
import Vuex, { createLogger } from "vuex"

import { auth } from './auth.module';

Vue.use(Vuex)

const contact = {
    firstname: "",
    lastname: "",
    email: "",
    message: ""
}
const store = new Vuex.Store({
    modules: {
        auth
    },
    state: {
        showModalContact: false,
        contact,
        showLogin: false,
        showRegister: false,
        showSign: true,
        showLogged: false,
        showProfile: false,
    },
    
    getters: {
        isShowContact: state => {
            return state.showModalContact
        },
        isShowLoginForm: state => {
            return state.showLogin
        },
        isShowRegisterForm: state => {
            return state.showRegister
        },
        isShowSignInOn: state => {
            return state.showSign
        },
        isShowLoggedIn: state => {
            return state.showLogged
        },
        isShowUserProfile: state => {
            return state.showProfile
        },
    },

    mutations: {
        showContact: state => {
            console.log('showContact')
            state.showModalContact = true
        },
        hideContact: state => {
            state.showModalContact = false
        },
        updateContact : (state, message) => {
            state.contact.message = message
            console.log({contact})
        }
    },
    actions: {},
    getters: {
        isShowContact: state => {
            return state.showModalContact
        },
        contact: state => {
            return state.contact
        },
        SHOW_LOGIN_FORM: (state, val) => {
            state.showLogin = val
        },
        SHOW_REGISTER_FORM: (state, val) => {
            state.showRegister = val
        },
        SHOW_SIGNIN_SIGNON:  (state, val) => {
            state.showSign = val
        },
        SHOW_LOGGEDIN: (state, val) => {
            state.showLogged = val
        },
        SHOW_USER_PROFILE: (state, val) => {
            state.showProfile = val
        },
    },

    actions: {
        toggleLoginForm: (store, val) => {
            store.commit('SHOW_LOGIN_FORM', val)
        },
        toggleRegisterForm: (store, val) => {
            store.commit('SHOW_REGISTER_FORM', val)
        },
        toggleSignInOn: (store, val) => {
            store.commit('SHOW_SIGNIN_SIGNON', val)
        },
        toggleLoggedIn: (store, val) => {
            store.commit('SHOW_LOGGEDIN', val)
        },
        toggleUserProfile: (store, val) => {
            store.commit('SHOW_USER_PROFILE', val)
        },
    },
})

global.store = store;
export default store;