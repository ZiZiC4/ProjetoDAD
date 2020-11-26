<template>
    <div>
        <div class="alert" :class="msgType" v-if="showMessage">
            <button type="button"
                class="close-btn"
                v-on:click="showMessage = false">&chi;</button>
            <strong>{{ message }}</strong>
        </div>
        <div class="jumbotron">
            <h2>Login</h2>
            <div class="form-group">
                <label for="inputEmail">E-Mail</label>
                <input type="email"
                    class="form-control"
                    v-model="credentials.email"
                    name="email"
                    id="inputEmail"
                    placeholder="Email address">
            </div>
            <div class="form-group">
                <label for="inputPassword">Password</label>
                <input type="password"
                    class="form-control"
                    v-model="credentials.password"
                    name="password"
                    id="inputPassword">
            </div>
            <div class="form-group">
                <a class="btn btn-primary" v-on:click.prevent="login">Login</a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: function(){
        return{
            credentials: {
                email: '',
                password: ''
            },
            msgType: "alert-success",
            showMessage: false,
            message: ""
        };
    },
    methods: {
        login() {
            console.log('Login')
        }
    }
}
</script>
