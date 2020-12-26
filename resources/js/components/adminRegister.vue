<template>
  <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <h1>Form Register</h1>
          <form enctype="multipart/form-data">

            <validation-errors :errors="validationErrors" v-if="validationErrors"></validation-errors>
            <div class="form-group">
              <label>Type</label>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" class="custom-control-input" value="a" name="type" id="type_admin" v-model="user.type">
                <label class="custom-control-label" for="type_admin">Admin</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" class="custom-control-input" value="o" name="type" id="type_operator" v-model="user.type">
                <label class="custom-control-label" for="type_operator">Operator</label>
              </div>
            </div>
            <div class="form-group" >
              <label for="name">Name</label>
              <input type="text" class="form-control" id="name" placeholder="A name for the user" v-model="user.name">
             </div>
             <div class="form-group" >
               <label for="email">Email</label>
               <input type="email" class="form-control" id="email" placeholder="Email" v-model="user.email">
              </div>
              <div class="form-group" >
                <label for="password">Password</label>
                <input  type="password" class="form-control" id="password" placeholder="Choose one password" v-model="user.password">
               </div>
               <div class="form-group">
                 <label for="password_confirmation">Confirm password</label>
                 <input type="password" class="form-control" id="password_confirmation" placeholder="Confirm password" data-vv-as="password" v-model="user.password_confirmation">
                </div>

                <!--  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="inputPhoto" v-on:change="onImageChange" ref="fileInput">
                    <label class="custom-file-label" for="inputPhoto">{{ user.photo.name }}</label>
                    <div class="invalid-feedback" v-if="invalidPhoto">
                        Please provide a valid photo.
                    </div>
                  </div>-->
                </form>

               <div class="text-center">
                  <button class="btn btn-primary" @click="registerAdmin()">Register</button>
               </div>
               <br>

          </div>
      </div>
  </div>
</template>

<script>
    export default {

      props:[
          "validationErrors"
          ],

    data: function() {
        return{
          validationErrors: '',
          user:{
            name: null,
            email: null,
            password: null,
            type:'',
            photo: '',
            photoBase64:''
          },
    }
  },
  methods: {

            registerAdmin(){
              axios.post('api/adminRegister', this.user).then(response=>{
                alert("User Registed!");
                //this.$router.push('/login')
            }).catch(error => {
              if (error.response.status == 422){
                this.validationErrors = error.response.data.errors;
              }
            });
          },
  },
        mounted() {


        }
    }
</script>
