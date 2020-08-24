import Vue from "vue"
import Vuex from "vuex"

Vue.use(Vuex)

const store = new Vuex.Store({
    state: {
        showModalContact: false,
    },
    mutations: {
        showContact: state => {
            console.log('showContact')
            state.showModalContact = true
        },
        hideContact: state => {
            state.showModalContact = false
        }
    },
    actions: {},
    getters: {
        isShowContact: state => {
            return state.showModalContact
        }
    },
})

global.store = store;
export default store;