<template>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Photo</th>
        <th>Name</th>
        <th>Email</th>
        <th>Actions</th>
        <th>Role</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <tr
        v-for="user in users"
        :key="user.id"
        :class="{ active: currentUser === user }"
      >
        <td v-if="user.photo">
          <img
            v-bind:src="'' + user.photo"
            style="width: 75px; height: 75px; border-radius: 50%"
          />
        </td>
        <td v-if="!user.photo">
          <img
            v-bind:src="''"
            style="width: 75px; height: 75px; border-radius: 50%"
          />
        </td>
        <td>{{ user.name }}</td>
        <td>{{ user.email }}</td>

        <!-- <a v-if="user.blocked =='0' " class="btn btn-sm btn-secondary" v-on:click.prevent="deactivateUser(user)">Deactivate</a>
              <a v-if="user.blocked =='1' " class="btn btn-sm btn-primary" v-on:click.prevent="activateUser(user)">Activate</a> -->
        <td>
          <a
            class="btn btn-xs btn-primary"
            v-if="user.type != 'C'"
            v-on:click.prevent="editUser(user)"
            >Edit</a>
          <a
            class="btn btn-xs btn-primary"
            v-if="user.id != currentUser.id && user.blocked == 0"
            v-on:click.prevent="blockUser(user)"
            >Block</a>
          <a
            class="btn btn-xs btn-success"
            v-if="user.id != currentUser.id && user.blocked == 1"
            v-on:click.prevent="blockUser(user)"
            >Activate</a>
          <a
            class="btn btn-xs btn-danger"
            v-if="user.id != currentUser.id"
            v-on:click.prevent="deleteUser(user)"
            >Delete</a>
        </td>
        <td>
          <a v-if="user.type == 'C'">Customer</a>
          <a v-if="user.type == 'EC'">Employee-Cook</a>
          <a v-if="user.type == 'ED'">Employee-Deliveryman</a>
          <a v-if="user.type == 'EM'">Employee-Manager</a>
        </td>
        <td>
          <a v-if="user.blocked == 0">Active</a>
          <a v-if="user.blocked == 1">Blocked</a>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script>
export default {
  props: ["users", "selectedUser"],
  data: function () {
    return {
      currentUser: this.$store.state.user,
      editingUser: null,
    };
  },
  watch: {
    selectedUser: function (val) {
      this.editingUser = this.selectedUser;
    },
  },
  methods: {
    editUser: function (user) {
      this.editingUser = user;
      this.$emit("edit-click", user);
    },
    deleteUser: function (user) {
      this.editingUser = null;
      this.$emit("delete-click", user);
    },
    blockUser: function (user) {
      this.$emit("block-user", user);
    },
  },
};
</script>
