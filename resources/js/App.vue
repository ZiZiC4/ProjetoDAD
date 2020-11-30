<template>
    <div>
        <router-link to="/">Home</router-link>
        <router-link to="/products">Menu</router-link>
        <router-link to="/users">Users</router-link> #
        <router-link to="/login">Login</router-link> #
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
        console.log('User has logged out')
      })
        .catch(error => {
          console.log('Invalid Logout')
        })
    },
    myself () {
      axios.get('/api/users/me').then(response => {
        console.log('User currently logged:')
        console.dir(response.data)
      })
        .catch(error => {
          console.log('Invalid Request')
        })
    }
  }
}
</script>
