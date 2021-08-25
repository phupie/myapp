import Vue from "vue";
import Vuex from "vuex";
import follow from "./modules/follow";

Vue.use(Vuex);

export default new Vuex.Store({
  modules: {
    follow,
  },
});