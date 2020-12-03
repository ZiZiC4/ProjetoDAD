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

import store from "./stores/global-store"

import Home from './components/home'
import UserComponent from './components/users'
//import UserProfile from './components/userProfile'
import LoginComponent from './components/login'
//import LogoutComponent from './components/logout'
import Product from './components/product'
import userProfile from './components/userProfile'

//const home = Vue.component("home", Home);
//const user = Vue.component("users", User);
//const login = Vue.component("login", Login);
//const logout = Vue.component("logout", Logout);



const routes = [
    { path: "/", component: Home},
    { path: "/login", component: LoginComponent},
    { path: "/users", component: UserComponent},
    //{ path: "/logout", component: LogoutComponent},
    { path: "/products", component: Product},
    { path: "/userProfile", component: userProfile}
]

const router = new VueRouter({
    routes:routes
})

import App from './App.vue'
new Vue({
    render: h => h(App),
    router,
    store,
    data: {

    }
}).$mount('#app')

router.beforeEach((to, from, next) => {
    console.log(to)
    if(!store.state.user) {
        if ((to.path === '/users')) {
            console.log('Não tem permissões')
            next(false)
            return
        }
    }
    next()
})