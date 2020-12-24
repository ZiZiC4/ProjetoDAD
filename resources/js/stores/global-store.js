
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
        removeProductFromOrder(state,id){
           // var position = orderProducts.findIndex(prod => prod.id === id);
           // console.log(id)
           // state.orderProducts.splice(position, 1)
           for(const idx in state.orderProducts){
               const prod = state.orderProducts[idx]
               if(prod.id == id){
                   state.orderProducts.splice(idx,1)
                   console.log("done")
                   return
               }
           }
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