/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");
window.Form = Form;
import { Form, HasError, AlertError } from "vform";
import moment from "moment";
import VueProgressBar from "vue-progressbar";
import VueFlashMessage from "vue-flash-message";
Vue.use(VueFlashMessage);
import Gate from "./Gate";
Vue.prototype.$gate = new Gate(window.user);

import Swal from "sweetalert2";
window.Swal = Swal;
const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: true,
    timer: 4000,
    timerProgressBar: true,
    onOpen: toast => {
        toast.addEventListener("mouseenter", Swal.stopTimer);
        toast.addEventListener("mouseleave", Swal.resumeTimer);
    }
});

window.Toast = Toast;

window.Fire = new Vue();

Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);

import VueRouter from "vue-router";

Vue.use(VueRouter);

let routes = [
    {
        path: "/Dashbor-d",
        component: require("./components/Dashbor-d.vue").default
    },
    {
        path: "/Pofile-User",
        component: require("./components/Pofile-User.vue").default
    },
    {
        path: "/users",
        component: require("./components/Users.vue").default
    },
    {
        path: "*",
        component: require("./components/not-found.vue").default
    },
    {
        path: "/add_post",
        component: require("./components/add_post.vue").default
    },
    {
        path: "/Request",
        component: require("./components/Request.vue").default
    },
    {
        path: "/add_offer",
        component: require("./components/add_offer.vue").default
    },
    {
        path: "/detail",
        component: require("./components/detail.vue").default
    },
    {
        path: "/offers",
        component: require("./components/offers.vue").default
    }
];
const router = new VueRouter({
    mode: "history",
    routes // short for `routes: routes`
});

Vue.filter("keys", function(keyy) {
    return keyy.toUpperCase();
});
Vue.filter("time", function(time) {
    return moment(time).format("dddd, MMMM Do YYYY");
});

const options = {
    color: "#bffaf3",
    failedColor: "#874b4b",
    thickness: "5px",
    transition: {
        speed: "0.1s",
        opacity: "0.6s",
        termination: 300
    },
    autoRevert: true,
    location: "top",
    inverse: false
};

Vue.use(VueProgressBar, options);
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component(
    "example-component",
    require("./components/ExampleComponent.vue")
);
Vue.component("not-found", require("./components/not-found.vue").default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app",
    router,
    data: {
        search: "",
        detail: {},
        h: ""
    },
    methods: {
        searchit: _.debounce(() => {
            Fire.$emit("serching");
        }, 1000)
    }
});
