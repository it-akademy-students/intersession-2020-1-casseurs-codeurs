import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        showModalContact: false,
    },

    getters: {
        isShowContact: state => {
            return state.showModalContact;
         },
    },

    mutations: {
        showContact: state => {
            state.showModalContact = true;
        },
        hideContact: state => {
            state.showModalContact = false;
        },
    },
});

global.store = store;
export default store;
