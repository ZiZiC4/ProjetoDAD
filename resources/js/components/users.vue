<template>
    <div>
        <div class="jumbotron">
            <h1>{{ title }}</h1>
        </div>

        <user-list :users="users" :selected-user="currentUser" v-on:edit-click="editClick"></user-list>

        <div class="alert alert-success" v-if="showSuccess">
            <button type="button" class="close-btn" v-on:click="showSuccess=false">&times;</button>
            <strong>{{ successMessage }}</strong>
        </div>
        
        <user-edit :user="currentUser" :departments="departments" 
        v-on:user-saved="saveUserClick" @user-canceled="cancelEditClick" v-if="editingUser"></user-edit>
            
    </div>
</template>

<script>
import UserListComponent from "./userList"
import UserEditComponent from './userEdit'
export default {
   components:{
        'user-list': UserListComponent,
        //'user-edit': UserEditComponent
    },
    data: function(){
    	return {
	        title: 'List Users',
	        editingUser: false,
	        showSuccess: false,
	        showFailure: false,
	        successMessage: '',
	        failMessage: '',
	        currentUser: null,
	        users: []
        }
    },
    methods: {
        editClick: function(user){
            this.currentUser = user
            this.editingUser = true
            this.showSuccess = false
        },
        saveUserClick: function (user) {
            this.editingUser = false
            this.showSuccess = true
            this.successMessage = 'User Saved'
            this.currentUser = null
            
        },
        cancelEditClick: function () {
            this.showSuccess = false
            this.editingUser = false
            
        },
        getUsers: function () {
            axios.get('api/users')
                .then(response => { this.users = response.data.data })
        }
    }   
}
</script>

