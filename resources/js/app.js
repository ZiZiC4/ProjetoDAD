require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router'
Vue.use(VueRouter)





import Home from './components/home'
import UserComponent from './components/users'
//import UserProfile from './components/userProfile'
import LoginComponent from './components/login'
//import LogoutComponent from './components/logout'
import Product from './components/product'

//const home = Vue.component("home", Home);
//const user = Vue.component("users", User);
//const login = Vue.component("login", Login);
//const logout = Vue.component("logout", Logout);



const routes = [
    { path: "/", component: Home},
    { path: "/login", component: LoginComponent},
    { path: "/users", component: UserComponent},
    //{ path: "/logout", component: LogoutComponent},
    { path: "/products", component: Product}
]

const router = new VueRouter({
    routes:routes
})

import App from './App.vue'
new Vue({
    render: h => h(App),
    router,
    data: {

    }
}).$mount('#app')
