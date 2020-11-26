<template>
    <div>
        <router-link to="/">Home</router-link>
        <router-link to="/users">Users</router-link>
        <router-link to="/login">Login</router-link>
        <router-link to="/logout">Logout</router-link>
        <router-link to="/products">Menu</router-link>

        <router-view></router-view>
    </div>
</template>

<script>
export default {
    methods: {
        logout() {
            axios
                .post("/api/logout")
                .then(response => {
                    console.log("User has logged out");
                })
                .catch(error => {
                    console.log("Invalid Logout");
                });
        }
    }
};
</script>
