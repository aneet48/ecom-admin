import Vue from "vue";
import Vuex from "vuex";
Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        user: null
    },

    mutations: {
        setUserData(state, userData) {
            state.user = userData;
            localStorage.setItem("user", JSON.stringify(userData));
            axios.defaults.headers.common.Authorization = `Bearer ${userData.api_token}`;
        },

        clearUserData() {
            localStorage.removeItem("user");
            location.reload();
        }
    },

    actions: {
        login({ commit }) {
            return axios.get("/auth-user").then(({ data }) => {
                commit("setUserData", data);
            });
        },

        logout({ commit }) {
            return axios.get("/logout").then(({ data }) => {
               commit("clearUserData");
               location.reload()
            });

        }
    },

    getters: {
        isLogged: state => !!state.user
    }
});
