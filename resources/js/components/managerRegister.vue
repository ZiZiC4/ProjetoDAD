<template>
    <div class="jumbotron">
        <h2>{{ title }}</h2>
                <!--<div class="form-group">
                    <label>Type: </label>
                    <div
                        class="custom-control custom-radio custom-control-inline"
                    >
                        <input
                            type="radio"
                            class="custom-control-input"
                            value="EM"
                            name="type"
                            id="type_manager"
                            v-model="user.type"
                            required
                        />
                        <label class="custom-control-label" for="type_admin"
                            >Manager</label
                        >
                    </div>
                    <div
                        class="custom-control custom-radio custom-control-inline"
                    >
                        <input
                            type="radio"
                            class="custom-control-input"
                            value="EC"
                            name="type"
                            id="type_cooks"
                            v-model="user.type"
                                    required
                                />
                                <label class="custom-control-label" for="type_cooks"
                                    >Cook</label
                                >
                            </div>
                            <div
                                class="custom-control custom-radio custom-control-inline"
                            >
                                <input
                                    type="radio"
                                    class="custom-control-input"
                                    value="ED"
                                    name="type"
                                    id="type_deliverymen"
                                    v-model="user.type"
                                    required
                                />
                                <label
                                    class="custom-control-label"
                                    for="type_deliverymen"
                                    >Deliverymen</label
                                >
                            </div>
                        </div>-->
                        <div class="form-group">
                            <label for="inputType">Type: </label>
                            <select
                                name="type"
                                id="type"
                                class="form-control"
                                v-model="user.type"
                                required
                            >
                                <option disabled selected>
                                    -- Select an option --
                                </option>
                                <option value="EM">Employee-Manager</option>
                                <option value="EC">Employee-Cook</option>
                                <option value="ED">Employee-Deliveryman</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputName">Name</label>
                            <input
                                type="text"
                                class="form-control"
                                v-model="user.name"
                                name="name"
                                id="inputName"
                                placeholder="Fullname"
                            />
                            <div class="invalid-feedback" v-if="badName">
                                Invalid name.
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail">Email</label>
                            <input
                                type="email"
                                class="form-control"
                                v-model="user.email"
                                name="email"
                                id="inputEmail"
                                placeholder="Email address"
                            />
                            <div class="invalid-feedback" v-if="badEmail">
                                Invalid email.
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword">Password</label>
                            <input
                                type="password"
                                class="form-control"
                                v-model="user.password"
                                name="password"
                                id="inputPassword"
                                placeholder="password"
                            />
                            <div class="invalid-feedback" v-if="badPassword">
                                Invalid password.
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPhoto">{{ user.photo.name }}</label>
                            <input
                                type="file"
                                class="form-control"
                                name="photo"
                                id="inputPhoto"
                                placeholder="upload Photo"
                                v-on:change="onImageChange"
                            />
                        </div>

                    <div class="text-center">
                        <button class="btn btn-primary" @click="adminRegister()">
                            Register
                        </button>
                    </div>
            </div>
</template>

<script>
    export default {
        data: function() {
            return {
                title: "Register an Employee",
                user: {
                    name: "",
                    email: "",
                    password: "",
                    type: "",
                    photo: { name: "Insert Photo", base64: "" }
                },
                showSuccess: false,
                showError: false,
                errors: [],
                successMessage: "",
                badName: false,
                badEmail: false,
                badPassword: false
            };
        },
        methods: {
            onImageChange: function(event) {
                let image = event.target.files[0];
                this.user.photo.name = image.name;
                this.createImage(image);
            },
            createImage: function(file) {
                let reader = new FileReader();
                reader.onload = e => {
                    this.user.photo.base64 = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            managerRegister() {
                axios
                    .post('api/users/newAccount', this.user)
                    .then(response => {
                        Object.assign(this.user, response.data);
                        this.$router.push("/");
                        this.$toasted.show("User Created");
                        console.log(response.data);
                    })
                    .catch(error => {
                        console.error(error);
                        if (error.response.data.errors.name) {
                            this.successMessage =
                                error.response.data.errors.name[0];
                            this.showError = true;
                        } else if (error.response.data.errors.email) {
                            this.successMessage =
                                error.response.data.errors.email[0];
                            this.showError = true;
                        } else if (error.response.data.errors.password) {
                            this.successMessage =
                                error.response.data.errors.password[0];
                            this.showError = true;
                        } else if (error.response.data.errors.type) {
                            this.successMessage =
                                error.response.data.errors.type[0];
                            this.showError = true;
                        } else if (error.response.data.errors.photo) {
                            this.successMessage =
                                error.response.data.errors.photo[0];
                            this.showError = true;
                        }
                    });
            },
            cancelCreate: function() {
                this.$emit("create-cancel");
                this.$router.push("/");
            }
        },

        mounted() {}
    };
</script>
