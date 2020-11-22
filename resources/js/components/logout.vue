<template>
    <div>
        <div class="alert" :class="msgType" v-if="showMessage">
            <button
                type="button"
                class="close-btn"
                v-on:click="showMessage = false"
            >
                &chi;
            </button>
            <strong>{{ message }}</strong>
        </div>
        <div class="jumbotron">
            <h2>Confirm Logout</h2>
            <div class="form-group">
                <a class="btn btn-primary" v-on:click.prevent="logout"
                    >Logout</a
                >
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: function() {
        return{
            msgType: "alert-success",
            showMessage: false,
            message: ""
        };
    },
}
</script>
