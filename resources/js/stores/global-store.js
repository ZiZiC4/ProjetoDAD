
import Vue from "vue"
import Vuex from "vuex"

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
      user: null,
      orderProducts:[],
      cookState:false,
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
        addProductToOrder(state, order){
            //console.log(typeof order.quant)
            //console.log(order.quant)
            state.orderProducts.push(order)
            sessionStorage.setItem('cart',orderProducts)
            //console.log(state.orderProducts)
        },
        removeProductFromOrder(state,id){
           // var position = orderProducts.findIndex(prod => prod.id === id);
           // console.log(id)
           // state.orderProducts.splice(position, 1)
           for(const idx in state.orderProducts){
               const prod = state.orderProducts[idx]
               if(prod.prod.id == id){
                   state.orderProducts.splice(idx,1)
                   console.log("done")
                   return
               }
           }
        },
        clearOrder(state){
            state.orderProducts = []
            sessionStorage.removeItem('cart')
        },
        setOrder(state,cart){
            state.orderProducts= cart
            sessionStorage.setItem('cart',state.orderProducts)
        },
        changeCookState(state,stateBoolean){
            state.cookState=stateBoolean;
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
        },
        rebuildOrderFromStorage (context){
            if(sessionStorage.getItem('cart')=== null){
                context.commit('clearOrder')
            }else{
                contex.commit('setOrder',sessionStorage.getItem('cart'))
            }
        }
    } 
})