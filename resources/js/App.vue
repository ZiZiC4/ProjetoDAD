<template>
    <div>
        <router-link to="/">Home</router-link>
        <router-link to="/products">Menu</router-link>
        <template v-if="$store.state.user">
          <router-link to="/users">Users</router-link> #
        </template>
        <template v-if="!$store.state.user">
          <router-link to="/login">Login</router-link> #
        </template>
        <router-link to="/userProfile">userProfile</router-link> #

        <!--<router-link to="/logout">Logout</router-link>-->
        <a href="#" @click.prevent="logout">Logout</a> #
        <a href="#" @click.prevent="myself">Myself</a>

        <router-view></router-view>
    </div>
</template>

<script>
export default {
  methods: {
    logout () {
      axios.post('/api/logout').then(response => {
        this.$toasted.show('User has logged out', { type: 'warning' })
        this.$store.commit('clearUser')

      })
        .catch(error => {
          this.$toasted.show('Invalid Logout Request', { type: 'error' })
        })
    },
    myself () {
      this.$store.dispatch('loadUserLogged')
      .then(() => {
        if(this.$store.state.user) {
          this.$toasted.show('User currently logged:<br><br>' + 
            this.$store.state.user.name + '<br>' + 
            this.$store.state.user.email, { type: 'info' })
          console.log('User currently logged:')
          console.dir(this.$store.state.user)
        }
        else {
          this.$toasted.show('No user is currently logged!', 
          { type: 'warning' })
          console.log('No user is currently logged:')
        }
      })
    }
  }
}
</script>

<style scoped>
.main-content-div {
  width: 95%;
  margin: 10px auto 10px auto;
}
</style>