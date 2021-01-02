<template>
  <div>
    <div class="jumbotron">
      <h1>{{ title }}</h1>
    </div>

    <table class="table table-striped">
      <tr v-if="user.photo == null">
        <td>
          <img
            v-bind:src="'../storage/fotos/1_5fdb48c5e2d1d.jpg'"
            style="
              width: 150px;
              height: 150px;
              border-radius: 50%;
              margin-bottom: 25px;
              margin-right: 25px;
              float: left;
            "
          />
        </td>
      </tr>
      <tr v-if="user.photo != null">
        <td>
          <img
            :src="'storage/fotos/' + user.photo"
            style="
              width: 150px;
              height: 150px;
              border-radius: 50%;
              margin-bottom: 25px;
              margin-right: 25px;
              float: left;
            "
          />
        </td>
      </tr>
      <tr>
        <td>Name:</td>
        <td>{{ this.user.name }}</td>
      </tr>
      <!-- <tr v-if="user.type == 'C'">
                <td>NIF:</td>
                <td>{{ this.customer.nif}}</td>
            </tr>
            <tr v-if="user.type == 'C'">
                <td>Address:</td>
                <td>{{ this.customer.address}}</td>
            </tr>
            <tr v-if="user.type == 'C'">
                <td>Phone:</td>
                <td>{{ this.customer.phone}}</td>
            </tr>-->
      <tr>
        <td>E-Mail:</td>
        <td>{{ this.user.email }}</td>
      </tr>
      <br />

      <a class="btn btn-sm btn-primary" v-on:click.prevent="profileEdit(user)"
        >Edit</a
      >
    </table>

    <div class="alert alert-success" v-if="showSuccess">
      <button type="button" class="close-btn" v-on:click="showSuccess = false">
        &times;
      </button>
      <strong>{{ successMessage }}</strong>
    </div>

    <div class="alert alert-danger" v-if="showFailure">
      <button type="button" class="close-btn" v-on:click="showFailure = false">
        &times;
      </button>
      <strong>{{ failMessage }}</strong>
    </div>

    <profile-edit
      :user="user"
      v-if="editingProfile"
      @cancel-edit="cancelEdit"
      @profile-modif="profileModif"
      @profile-erro-pass-equal="profileErroPassEqual"
      @profile-erro-pass-diff="profileErroPassDiff"
      @profile-erro-pass="profileErroPass"
      @profile-invalid-name="erroname"
      @profile-invalid-password="erropass"
      @profile-invalid-email="erroemail"
      @profile-invalid-image="erroimage"
    ></profile-edit>
  </div>
</template>
<script>
import ProfileEdit from "./profileEdit";
export default {
  data: function () {
    return {
      title: "Profile",
      user: {
        id: this.$store.state.user.id,
        name: this.$store.state.user.name,
        email: this.$store.state.user.email,
        photo: this.$store.state.user.photo_url,
        type: this.$store.state.user.type,
      },
      /*customer:{
                nif: this.$store.state.customer.nif,
                address: this.$store.state.customer.address,
                phone: this.$store.state.customer.phone,
            },*/
      editingProfile: false,
      showSuccess: false,
      showFailure: false,
      successMessage: "",
      failMessage: "",
    };
  },
  methods: {
    profileEdit: function (user) {
      this.showFailure = false;
      this.showSuccess = false;
      this.editingProfile = true;
    },

    profileModif: function () {
      this.showSuccess = true;
      this.showFailure = false;
      this.editingProfile = false;
      this.successMessage = "User successfully modified";
      this.user = this.$store.state.user;
    },

    profileErroPass: function () {
      this.showFailure = true;
      this.showSuccess = false;
      this.failMessage = "Wrong Old Password!";
    },

    profileErroPassEqual: function () {
      this.showFailure = true;
      this.showSuccess = false;
      this.failMessage = "New Password and Old Password are the same!";
    },

    profileErroPassDiff: function () {
      this.showFailure = true;
      this.showSuccess = false;
      this.failMessage = "Password and confirm password are different!";
    },

    cancelEdit: function () {
      this.editingProfile = false;
    },

    erroname: function () {
      this.showFailure = true;
      this.showSuccess = false;
      this.failMessage = "The name format is invalid!";
    },

    erroemail: function () {
      this.showFailure = true;
      this.showSuccess = false;
      this.failMessage = "The email format is invalid!";
    },

    erropass: function () {
      this.showFailure = true;
      this.showSuccess = false;
      this.failMessage = "The password must be at least 3 characters!";
    },

    /* erronif: function(){
            this.showFailure = true
            this.showSuccess = false
            this.failMessage = "The nif must be 9 digits."
        },*/

    erroimage: function () {
      this.showFailure = true;
      this.showSuccess = false;
      this.failMessage = "Invalid Image!";
    },

    /*getCustomer: function(){
            if (this.$store.state.user.type == 'C') {
                axios.get("api/customer/perfil", {id:this.$store.state.user.id}).then(response =>{
                    
                    this.customer = response.data
                })    
            } 
        },*/
  },
  components: {
    "profile-edit": ProfileEdit,
  },
  mounted() {},
};
</script>

<style>
</style>