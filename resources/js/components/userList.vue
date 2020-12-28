<template>
    <table class="table table-striped">
        <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                    <th>Role</th>
                    <th>State</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in users"  :key="user.id" :class="{active: currentUser === user}">
                    <!-- <td v-if="user.photo"><img v-bind:src="'' + user.photo" style="width:75px; height:75px; border-radius:50%;"></td>
                    <td v-if="!user.photo"><img v-bind:src="''" style="width:75px; height:75px; border-radius:50%;"></td> -->
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td v-if="user.blocked==0">Active</td>
                    <td v-if="user.blocked==1">Blocked</td>
                    <td v-if="user.type != 'C' || user.type == 'EC' || user.type == 'ED'"> - </td>
                    <td>
                        <!--<a class="btn btn-xs btn-primary" v-on:click.prevent="editUser(user)">Edit</a>-->
                        <a class="btn btn-xs btn-danger" v-if="user.id != currentUser.id" v-on:click.prevent="deleteUser(user)">Delete</a>
                    </td>

                    <td v-if="user.type == 'C'">Customer</td>
                    <td v-if="user.type == 'EC'">Employee-Cook</td>
                    <td v-if="user.type == 'ED'">Employee-Deliveryman</td>
                    <td v-if="user.type == 'EM'">Employee-Manager</td>
                </tr>
            </tbody>
    </table>
</template>

<script>
export default {
    props:['users'],
    data:function(){
        return{
            currentUser: this.$store.state.user
        }
    },
    methods:{
        editUser(user){
            this.currentUser = user //faz com que o click em edit fique a azul
            this.$emit('edit-user',user)
        },
        deleteUser(user){
            this.$emit('delete-user', user)
        },
        activateUser(user){
            this.$emit('activate-user', user)
        }
        //fazer metodo blockedUser
    }
}
</script>
