import Vue from "vue"
import Vuex, { createLogger } from "vuex"

Vue.use(Vuex)

const contact = {
    firstname: "",
    lastname: "",
    email: "",
    message: ""
}
const store = new Vuex.Store({
    state: {
        showModalContact: false,
        contact
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
        }
    },
})

global.store = store;
export default store;