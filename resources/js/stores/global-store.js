
import Vue from "vue"
import Vuex from "vuex"

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
      user: null,
    },
    mutations: {
        clearUser (state) {
            state.user = null
            sessionStorage.removeItem('user')
        },
        setUser (state, user) {
            state.user = user
            sessionStorage.setItem('user', JSON.stringify(user))
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