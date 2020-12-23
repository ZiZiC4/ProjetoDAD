
import Vue from "vue"
import Vuex from "vuex"

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
      user: null,
      orderProducts:[],
    },
    mutations: {
        clearUser (state) {
            state.user = null
            sessionStorage.removeItem('user')
        },
        setUser (state, user) {
            state.user = user
            sessionStorage.setItem('user', JSON.stringify(user))
        },
        addProductToOrder(state, product){
            state.orderProducts.push(product)
        },
        removeProductFromOrder(state){
           // var position = orderProducts.findIndex(prod => prod.id === id);
            console.log("Hello")
           // state.orderProducts.splice(position, 1)
        },
        clearOrder(state){
            state.orderProducts = []
        }
    },
    actions: {
        loadUserLogged (context) {
            axios.get('/api/users/me')
                .then(response => {
                    context.commit('setUser', response.data)
                })
                .catch(error => {
                    context.commit('clearUser')
            })
        }
    } 
})