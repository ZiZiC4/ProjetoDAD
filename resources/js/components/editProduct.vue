<template>
  <div class="jumbotron">
    <h2>EDIT PRODUCT</h2>
    <div class="form-group">
      <label for="inputType">Type: </label>
      <select
        name="type"
        id="type"
        class="form-control"
        v-model="product.type"
        required
      >
        <option disabled selected>-- Select an option --</option>
        <option value="hot dish">Hot dish</option>
        <option value="cold dish">Cold dish</option>
        <option value="drink">Drink</option>
        <option value="dessert">Dessert</option>
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
      <label for="inputDescription">Description</label>
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
      <label for="inputPrice">Price</label>
      <input
        type="price"
        class="form-control"
        v-model="product.price"
        name="price"
        id="inputprice"
        placeholder="price"
      />
    </div>
    <!--<div class="form-group">
                            <label for="inputPhoto">{{ product.photo.name }}</label>
                            <input
                                type="file"
                                class="form-control"
                                name="photo"
                                id="inputPhoto"
                                placeholder="upload Photo"
                                v-on:change="onImageChange"
                            />
                        </div> -->

    <div class="form-group">
      <a class="btn btn-primary" v-on:click.prevent="saveProduct()">Save Product</a>
      <a class="btn btn-light" v-on:click.prevent="cancelEdit()">Cancel Edit</a>
    </div>
  </div>
</template>

<script>
export default {
  props: ["prod"],
  data: function () {
    return {
      title: "EDIT a Product",
      product: this.prod,
      /*product: {
        name: "",
        type: "",
        description: "",
        price: "",
        photo: { name: "Insert Photo", base64: "" },
      },*/
      showSuccess: false,
      showError: false,
      errors: [],
      successMessage: "",
    };
  },
  methods: {
    saveProduct: function () {
      axios
        .put("api/products/" + this.product.id, this.product)
        .then((response) => {
          Object.assign(this.product, response.data.data);
          this.$emit("product-saved", this.product);
          //     this.$store.commit('setproduct', this.product);
        });
    },
    cancelEdit: function () {
      axios.get("api/products/" + this.product.id).then((response) => {
        Object.assign(this.product, response.data.data);
        this.$emit("product-canceled", this.product);
      });
    },
  },
};
</script>
