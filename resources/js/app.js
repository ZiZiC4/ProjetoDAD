require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router'
Vue.use(VueRouter)

import Toasted from 'vue-toasted'
Vue.use(Toasted, {
    position: 'top-center',
    duration: 5000,
    type: 'info',
})

import { BPagination } from 'bootstrap-vue'
Vue.component('b-pagination', BPagination)

import VueSimpleAlert from "vue-simple-alert"
Vue.use(VueSimpleAlert);

import ToggleSwitch from 'vuejs-toggle-switch'
Vue.use(ToggleSwitch)


import store from "./stores/global-store"

import Home from './components/home'
import UserComponent from './components/users'
import LoginComponent from './components/login'
import LogoutComponent from './components/logout'
import Product from './components/product'
import UserProfile from './components/userProfile'
import UserRegister from './components/userRegister'
import ManagerRegister from './components/managerRegister'
import cookDashboard from './components/cookDashboard'
import costumerCart from './components/costumerCart'
//const home = Vue.component("home", Home);
//const user = Vue.component("users", User);
//const login = Vue.component("login", Login);
//const logout = Vue.component("logout", Logout);
//const userRegister = Vue.component("usersRegister", UserRegister);
//const adminRegister = Vue.component("adminRegister", adminRegisterComponent);

const routes = [
    { path: "/", component: Home},
    { path: "/login", component: LoginComponent, name: "login"},
    { path: "/users", component: UserComponent, name: "users"},
    { path: "/logout", component: LogoutComponent, name: "logout"},
    { path: "/products", component: Product, name: "products"},
    { path: "/userProfile", component: UserProfile, name: "usersProfile"},
    { path: "/users/newAccount", component: UserRegister, name: "usersRegister"},
    { path: "/users/newEmployee", component: ManagerRegister, name: "managerRegister"},
    { path: "/cookDashboard", component: cookDashboard},
    { path: "/customerShopCart", component: costumerCart},
]


const router = new VueRouter({
    routes:routes
})

import App from './App.vue'

const app = new Vue({
    render: h => h(App),
    router,
    store,
    data: {

    },
    created (){
        this.$store.dispatch('loadUserLogged')
    }
}).$mount('#app')

router.beforeEach((to, from, next) => {
    if (to.name == "logout") {
        if (!app.$store.state.user) {
            next("/login");
            return;
        }
    }
    if (to.name == "users") {
        if (!app.$store.state.user) {
            next("/login");
            return;
        }
    }
    if (to.name == "users") {
        if (app.$store.state.user.type != 'EM') {
            next("/");
            return;
        }
    }
    if (to.name == "usersProfile") {
        if (!app.$store.state.user) {
            next("/login");
            return;
        }
    }
    if (to.name == "login") {
        if (app.$store.state.user) {
            next("/");
            return;
        }
    }
    console.log(to)
    if(!store.state.user) {
        if ((to.path === '/users')) {
            console.log('Não tem permissões')
            next(false)
            return
        }
    }
    next();
})