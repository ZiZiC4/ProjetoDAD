require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router'
Vue.use(VueRouter)





import Home from './components/home'
import UserComponent from './components/users'
//import UserProfile from './components/userProfile'
import LoginComponent from './components/login'
import LogoutComponent from './components/logout'

//const home = Vue.component("home", Home);
//const user = Vue.component("users", User);
//const login = Vue.component("login", Login);
//const logout = Vue.component("logout", Logout);



const routes = [
    { path: "/", component: Home},
    { path: "/users", component: UserComponent},
    { path: "/login", component: LoginComponent},
    { path: "/logout", component: LogoutComponent}
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
