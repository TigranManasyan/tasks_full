import Vue from 'vue'
import Vuex from 'vuex';
import Tasks from "./modules/Tasks";

Vue.use(Vuex)

const store = new Vuex.Store({
  state: {},
  mutations: {},
  getters: {},
  actions: {},
  modules: {
    Tasks
  }
})
export default store
