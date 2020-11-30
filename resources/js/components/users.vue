<template>
    <div>
        <div class="jumbotron">
            <h1>{{ title }}</h1>
        </div>

        <user-list
            :users="users"
            :selected-user="currentUser"
            @edit-click="editUser"
            @delete-click="deleteUser"
        ></user-list>

        <div class="alert alert-success" v-if="showSuccess">
            <button
                type="button"
                class="close-btn"
                v-on:click="showSuccess = false"
            >
                &times;
            </button>
            <strong>{{ successMessage }}</strong>
        </div>

        <user-edit
            v-if="currentUser"
            :user="currentUser"
            @user-saved="saveUser"
            @user-canceled="cancelEdit"
        ></user-edit>
    </div>
</template>

<script>
import UserListComponent from "./userList";
import UserEditComponent from "./userEdit";
export default {
    components: {
        "user-list": UserListComponent,
        "user-edit": UserEditComponent
    },
    data: function() {
        return {
            title: "List Users",
            showSuccess: false,
            showFailure: false,
            successMessage: "",
            failMessage: "",
            currentUser: null,
            users: []
        };
    },
    methods: {
        editUser: function(user) {
            this.currentUser = user;
            this.showSuccess = false;
        },
        deleteUser: function(user) {
            axios.delete("api/users/" + user.id).then(response => {
                this.showSuccess = true;
                this.successMessage = "User Deleted";
                this.getUsers();
            })
        },
        saveUser: function(user) {
            this.showSuccess = true;
            this.successMessage = "User Saved";
            Object.assign(this.currentUser, user)
            this.currentUser = null;
        },
        cancelEditClick: function() {
            this.showSuccess = false;
            Object.assign(this.currentUser, user)
            this.editingUser = false;
        },
        getUsers: function() {
            axios.get("api/users").then(response => {
                this.users = response.data.data;
            })
        }
    },
    mounted () {
        this.getUsers()
    }
}
</script>
