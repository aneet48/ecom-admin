/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");
import Vuetify from "vuetify";
import VueRouter from "vue-router";
import VueSweetalert2 from "vue-sweetalert2";
import store from "./store";
import VueVideoPlayer from "vue-video-player";

Vue.use(Vuetify);
Vue.use(VueRouter);
Vue.use(VueSweetalert2);
Vue.use(VueVideoPlayer);

// axios.defaults.baseURL = "http://woodbox.test/api";

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component("dashboard-component", require("./pages/Dashboard.vue").default);
Vue.component("dashboard-component", require("./App.vue").default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import Dashboard from "./pages/Dashboard.vue";
import Users from "./pages/users/Users.vue";
import CreateUser from "./pages/users/create-user.vue";
import States from "./pages/settings/States.vue";
import Products from "./pages/Products/ProductsList.vue";
import RequestList from "./pages/Products/RequestList.vue";
import Cities from "./pages/settings/Cities.vue";
import Feedback from "./pages/settings/Feedback.vue";
import Coupan from "./pages/settings/Coupans.vue";
import EventsSettings from "./pages/settings/Events.vue";
import Universities from "./pages/settings/Universities.vue";
import Wait from "./pages/Wait.vue";
import ProductCategories from "./pages/Products/Categories.vue";
import Events from "./pages/Events/EventsList.vue";
import EventCategories from "./pages/Events/Categories.vue";

const routes = [
    { path: "/", component: Dashboard, name: "Dashboard" },
    { path: "/users", component: Users, name: "Users" },
    { path: "/users/create", component: CreateUser, name: "Create User" },
    { path: "/users/edit/:id", component: CreateUser, name: "Edit User" },
    { path: "/states", component: States, name: "States" },
    { path: "/cities", component: Cities, name: "Cities" },    
    { path: "/colleges", component: Universities, name: "Colleges" },
    { path: "/products-list", component: Products, name: "Products" },
    // { path: "/products-categories", component: ProductCategories, name: "Products Categories" },
    {
        path: "/products-categories/:id?",
        component: ProductCategories,
        name: "Products Categories"
    },
    { path: "/events-list", component: Events, name: "Events" },
    // { path: "/products-categories", component: ProductCategories, name: "Products Categories" },
    {
        path: "/events-categories/:id?",
        component: EventCategories,
        name: "Events Categories"
    },
    { path: "/login-redirect", component: Wait, name: "Login Redirect" },
    { path: "/settings/events", component: EventsSettings, name: "EventsSettings" },
    { path: "/feedback", component: Feedback, name: "Feedback" },
    { path: "/coupans", component: Coupan, name: "Coupan" },
    { path: "/product-requests", component: RequestList, name: "Product Requests List" },
    
    
];

Vue.component("SearchBar", () => import("./components/SearchBar"));

const router = new VueRouter({
    routes
});

const app = new Vue({
    el: "#app",
    vuetify: new Vuetify(),
    router,
    store,

    created() {
        if (this.$router.currentRoute.name != "Login Redirect") {
            const userInfo = localStorage.getItem("user");
            const userData = JSON.parse(userInfo);

            if (!userData || !userData.api_token) {
                this.$store
                    .dispatch("login")
                    .then(() => {
                        location.reload();
                    })
                    .catch(err => {
                        console.log(err);
                    });
            } else {
                this.$store.commit("setUserData", userData);
            }
        }
    }
});
