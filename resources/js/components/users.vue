<template>
  <div>
    <div class="jumbotron">
      <h1>{{ title }}</h1>
    </div>

    <table class="table table-striped">
      <thead>
        <tr>
          <th>Name</th>
          <th>Type</th>
          <th>Email</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <input
              type="text"
              name="name"
              class="form-control"
              placeholder="Search by user name"
              v-model="search.name"
            />
          </td>
          <td>
            <select name="type" class="form-control" v-model="search.type">
              <option value="" selected>Type of User</option>
              <option value="C">Customer</option>
              <option value="EC">Employee-Cook</option>
              <option value="ED">Employee-Deliveryman</option>
              <option value="EM">Employee-Manager</option>
            </select>
          </td>
          <td>
            <input
              type="email"
              name="email"
              class="form-control"
              placeholder="Search by e-mail"
              v-model="search.email"
            />
          </td>
          <td>
            <select name="blocked" id="form-control" v-model="search.blocked">
              <option value="" selected>Status of User</option>
              <option value="0">Active</option>
              <option value="1">Blocked</option>
            </select>
          </td>
          <td>
            <button
              type="submit"
              class="btn btn-primary"
              v-on:click="getResults()"
            >
              Search
            </button>
          </td>
        </tr>
      </tbody>
    </table>

    <user-list
      :users="users"
      :selected-user="currentUser"
      @edit-click="editUser"
      @delete-click="deleteUser"
      @block-user="blockUser"
    ></user-list>

    <div class="alert alert-success" v-if="showSuccess">
      <button type="button" class="close-btn" v-on:click="showSuccess = false">
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

    <!--<user-list
      v-bind:users="users"
      v-on:edit-user="editUser"
      v-on:delete-user="deleteUser"
      v-on:block-user="blockUser"
    ></user-list>

    <edit-list
      v-if="editingUser"
      v-bind:currentUser="currentUser"
      v-on:save-user="saveUser"
      v-on:cancel-edit="cancelEdit"
    ></edit-list>-->

    <div>
      <b-pagination
        align="left"
        size="md-c"
        v-model="page"
        :limit="10"
        :total-rows="total"
        :per-page="10"
        @input="getResults(page)"
      ></b-pagination>
      <br />
    </div>
  </div>
</template>

<script>
  import UserListComponent from "./userList";
  import UserEditComponent from "./userEdit";
  export default {
    components: {
      "user-list": UserListComponent,
      "user-edit": UserEditComponent,
    },

    data: function () {
      return {
        title: "List of Users",
        page: 1,
        total: 1,
        editingUser: false,
        showSuccess: false,
        showFailure: false,
        successMessage: "",
        failMessage: "",
        currentUser: null,
        users: [],
        search: {
          name: "",
          type: "",
          email: "",
          blocked: "",
        },
      };
    },
    methods: {
      editUser: function (user) {
        //this.currentUser = user;
        this.currentUser = Object.assign({}, user);
        this.editingUser = true;
        this.showSuccess = false;
      },
      deleteUser: function (user) {
        axios.delete("api/users/destroy" + user.id).then((response) => {
          this.showSuccess = true;
          this.successMessage = "User Deleted with success";
          this.getResults(1)
        });
      },
      methods: {
          editUser: function(user) {
              //this.currentUser = user;
              this.currentUser = Object.assign({}, user);
              this.editingUser = true;
              this.showSuccess = false;
          },

          deleteUser: function(user) {
              axios.delete('api/users/destroy/'+user.id)
              .then(response=>{
                  this.getUsers();
                  this.$toasted.success('User removed with success!');
              })
              .catch(error => {

                  console.log(error);
              });
          },
          /* deleteUser: function(user) {
              axios.delete("api/users/destroy/" + user.id).then(response => {
                  this.showSuccess = true;
                  this.successMessage = "User Deleted with success";
                  this.getResults(1);
              });
          }, */
        
      saveUser: function (user) {
        this.showSuccess = true
        this.successMessage = "User Saved"
        Object.assign(this.currentUser, user)
        this.currentUser = null
      },
      cancelEdit: function () {
        this.showSuccess = false
        // Copies user properties to this.currentUser
        // without changing this.currentUser reference
        Object.assign(this.currentUser, user)
        this.currentUser = null
      },
      getResults(page) {
        this.editingUser = false;
        this.showFailure = false;
        this.showSuccess = false;
        axios
          .post("api/users/filter?page=" + page, this.search)
          .then((response) => {
            this.users = response.data.data;
            this.page = response.data.meta.current_page;
            this.total = response.data.meta.total;
          })
          .catch((error) => {
            this.failMessage = "Error, can't get the users!";
            this.showFailure = true;
            this.showSuccess = false;
          });
      },

      getUsers: function () {
        axios.get("api/users").then((response) => {
          this.users = response.data.data;
        });
      },

      blockUser: function (user) {
        axios.put("api/users/blocked/" + user.id).then((response) => {
          this.showSuccess = true;
          if (user.blocked == 0) {
            this.successMessage = " User Active ";
          } else {
            this.successMessage = " User Blocked";
          }
          this.getResults(1);
        });
      },
    },
    mounted() {
      //this.getUsers();
      this.getResults(1); 
    },
  }
  }
</script>

<style>
</style>