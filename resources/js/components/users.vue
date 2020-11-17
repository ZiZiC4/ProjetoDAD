<template>
    <div>
        <div class="jumbotron">
            <h1>{{ title }}</h1>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <input type="text" name="name" class="form-control" placeholder="Search by user name" v-model="search.name">

                    </td>
                    <td>
                        <select name="type" class="form-control" v-model="search.type">
                            <option value='' selected> Type of User</option>
                            <option value="c">Customer</option>
                            <option value="ec">Employee-Cook</option>
                            <option value="ed">Employee-Deliveryman</option>
                            <option value="em">Employee-Manager</option>
                        </select>
                    </td>
                    <td>
                        <input type="email" name="email" class="form-control" placeholder="Search by e-mail" v-model="search.email">
                    </td>
                    <td>
                        <button type="submit" class="btn btn-primary" v-on:click="getSearched()">Search</button>
                    </td>
                </tr>
            </tbody>
        </table>  
        
            
    </div>
</template>

<script>
import UserList from "./userList.vue";

export default {
    data: function(){
        return{
            title: "Users List",
            listUsers: true,
            showSuccess: false,
            showFailure: false,
            users: [],
            search:{
                name:'',
                type:'',
                email:'',
            }
        };
    },
    methods:{
        getSearched(){
            this.showSuccess = false;
            this.showFailure = false;
            axios.post('api/users/filter?page='+page, this.search)
            .then(response=>{
                console.log(response.data.data)
                this.users = response.data.data;
            }).catch(error=>{
                this.failMessage = "Can't get the users! ERROR!"
                this.showFailure = true;
                this.showSuccess = false;
            });
        },

        getUsers: function(){
            axios.get('api/users')
            .then(response=>{
                console.log(response)
                this.users = response.data.data;
            });
        },
    },

        components: {
            "user-list": UserList,
        }   
}
</script>

