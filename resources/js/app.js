require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router'
Vue.use(VueRouter)

import Toasted from "vue-toasted";

Vue.use(Toasted, {
    position: "bottom-center",
    duration: 5000,
    type: "info"
});


import Home from './components/home'
import User from './components/users'

const home = Vue.component("home", Home);
const user = Vue.component("users", User);

import { BPagination } from 'bootstrap-vue'
Vue.component('b-pagination', BPagination)



const routes = [
    { path: "/", component: Home},
    { path: "/users", component: User, name: "users"}
]

const router = new VueRouter({
    routes // é como termos routes:routes
})

