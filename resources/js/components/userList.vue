<template>
    <table class="table table-striped">
        <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in users" :key="user.id" :class="{active: currentUser === user}">
                    <td v-if="user.photo"><img v-bind:src="'' + user.photo" style="width:75px; height:75px; border-radius:50%;"></td>
                    <td v-if="!user.photo"><img v-bind:src="''" style="width:75px; height:75px; border-radius:50%;"></td>
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>

                </tr>
            </tbody>
    </table>
</template>

<script>
export default {
    props:['users'],
    data:function(){
        return{
            currentUser
        }
    },
    methods:{
        editUser(user){
            this.currentUser = user
        }
    }
};
</script>
