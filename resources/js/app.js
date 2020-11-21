require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router'
Vue.use(VueRouter)





import Home from './components/home'
import User from './components/users'

//const home = Vue.component("home", Home);
//const user = Vue.component("users", User);





const routes = [
    { path: "/", component: Home},
    { path: "/users", component: User}
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
