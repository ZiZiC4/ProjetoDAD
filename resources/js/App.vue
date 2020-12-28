<template>
    <div>
        <router-link to="/">Home</router-link> #
        <router-link to="/products">Menu</router-link> -
        <router-link to="/customerShopCart">Shopping Cart</router-link> #
        <router-link to="/login" v-if="!$store.state.user">Login</router-link>
        <router-link to="/userProfile" v-if="$store.state.user">userProfile</router-link> #
        <router-link to="/users/newAccount" v-if="!$store.state.user">Register </router-link>
        <router-link to="/logout" v-if="$store.state.user">Logout</router-link>
        <router-link to="/cookDashboard" v-if="$store.state.user && this.$store.state.user.type == 'EC'">Cook Dashboard</router-link>
        <router-link to="/users" v-if="$store.state.user && this.$store.state.user.type == 'EM'">Users</router-link> #
        <router-link to="/users/newAccount">MANAGE: REGISTER</router-link>
    
        
        <!--<router-link to="/logout">Logout</router-link>-->
        <!--<a href="#" @click.prevent="logout">Logout</a> #-->
        <!--<a href="#" @click.prevent="myself">Myself</a> -->
        

        <router-view></router-view>
    </div>
</template>

<script>
export default {
 
}
</script>

<style scoped>
.main-content-div {
  width: 95%;
  margin: 10px auto 10px auto;
}
</style>