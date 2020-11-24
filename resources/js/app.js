require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router'
Vue.use(VueRouter)





import Home from './components/home'
import UserComponent from './components/users'
//import UserProfile from './components/userProfile'
import Login from './components/login'
import Logout from './components/logout'

//const home = Vue.component("home", Home);
//const user = Vue.component("users", User);
//const login = Vue.component("login", Login);
//const logout = Vue.component("logout", Logout);



const routes = [
    { path: "/", component: Home},
    { path: "/users", component: UserComponent},
    { path: "/login", component: Login, name: "login"},
    { path: "/logout", component: Logout, name: "logout"}
]

const router = new VueRouter({
    routes:routes // é como termos routes:routes
})

import App from './App.vue'
new Vue({
    render: h => h(App),
    router,
    data: {

    }
}).$mount('#app')
