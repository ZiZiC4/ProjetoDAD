<template>
    <table class="table table-striped">
        <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in users"  :key="user.id" :class="{active: selectedUser === user}">
                    <!-- <td v-if="user.photo"><img v-bind:src="'' + user.photo" style="width:75px; height:75px; border-radius:50%;"></td>
                    <td v-if="!user.photo"><img v-bind:src="''" style="width:75px; height:75px; border-radius:50%;"></td> -->
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td>
                        <a class="btn btn-xs btn-primary" v-on:click.prevent="editUser(user)">Edit</a>
                    </td>

                    <td v-if="user.type == 'c'">Customer</td>
                    <td v-if="user.type == 'ec'">Employee-Cook</td>
                    <td v-if="user.type == 'ed'">Employee-Deliveryman</td>
                    <td v-if="user.type == 'em'">Employee-Manager</td>
                </tr>
            </tbody>
    </table>
</template>

<script>
export default {
    data:function(){
        return{
            users: []
        }
    },
       props:[
           'users',
           'selectedUser'
       ],
    methods:{
        getUser: function(){
            axios.get('api/users')
            .then(response => {
                this.users = response.data.data
            })
        },
        editUser(user){
            this.$emit('edit-click',user)
        }
    },
    mounted (){
        this.getUser();
    }
}
</script>
