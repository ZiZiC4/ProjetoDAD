<template>
    <div class="jumbotron">
        <h2>{{ title }}</h2>
                    <div class="form-group">
                            <label for="inputType">Type: </label>
                            <select
                                name="type"
                                id="type"
                                class="form-control"
                                v-model="product.type"
                                required
                            >
                                <option disabled selected>
                                    -- Select an option --
                                </option>
                                <option value="hot dish">hot dish</option>
                                <option value="cold dish">cold dish</option>
                                <option value="drink">drink</option>
                                 <option value="dessert">dessert</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputName">Name</label>
                            <input
                                type="text"
                                class="form-control"
                                v-model="product.name"
                                name="name"
                                id="inputName"
                                placeholder="Fullname"
                            />
    
                        </div>
                        <div class="form-group">
                            <label for="inputDescription">description</label>
                            <input
                                type="description"
                                class="form-control"
                                v-model="product.description"
                                name="description"
                                id="inputDescription"
                                placeholder="description"
                            />
                           
                        </div>
                        <div class="form-group">
                            <label for="inputPrice">price</label>
                            <input
                                type="price"
                                class="form-control"
                                v-model="product.price"
                                name="price"
                                id="inputprice"
                                placeholder="price"
                            />
                        </div>
                         <div class="form-group">
                            <label for="inputPhoto">{{ product.photo.name }}</label>
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
                        <button class="btn btn-primary" @click='saveProduct()'>
                            SAVE PRODUCT
                        </button>
                    </div>
            </div>
</template>

<script>
export default {
    data: function() {
            return {
                title: "EDIT a Product",
                product: {
                    name: "",
                    type: "",
                    description: "",
                    price: "",
                     photo: { name: "Insert Photo", base64: "" }
                },
                showSuccess: false,
                showError: false,
                errors: [],
                successMessage: "",
            };
        },    
    methods: {
        saveProduct: function() {
            axios.put('api/products/' + this.product.id, this.product).
            then(response => {
                Object.assign(this.product, response.data.data)
                this.$emit('product-saved', this.product)
           //     this.$store.commit('setproduct', this.product);
            });
        },
        cancelEdit: function() {
            axios.get('api/products/' + this.product.id).then(response => {
                Object.assign(this.product, response.data.data)
                this.$emit('product-canceled', this.product)
            });
        }
    }
};
</script>
