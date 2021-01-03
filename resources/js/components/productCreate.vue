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
        placeholder="Description"
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
        placeholder="Price"
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
      <button class="btn btn-primary" @click="CreateProduct()">
        Create Product
      </button>
    </div>
  </div>
</template>

<script>
export default {
  data: function () {
    return {
      title: "ADD a Product",
      product: {
        name: "",
        type: "",
        description: "",
        price: "",
        photo: { name: "Insert Photo", base64: "" },
      },
      showSuccess: false,
      showError: false,
      errors: [],
      successMessage: "",
    };
  },
  methods: {
    CreateProduct() {
      axios.post("api/product/newProduct", this.product).then(response => {
        Object.assign(this.product, response.data);
        this.$router.push("/");
        this.$toasted.show("Product Created");
        //console.log(response.data);
      });
    },

    onImageChange: function (event) {
      let image = event.target.files[0];
      this.product.photo.name = image.name;
      this.createImage(image);
    },
    createImage: function (file) {
      let reader = new FileReader();
      reader.onload = (e) => {
        this.product.photo.base64 = e.target.result;
      };
      reader.readAsDataURL(file);
    },
    cancelCreate: function () {
      this.$emit("create-cancel");
      this.$router.push("/");
    },
  },

  mounted() {},
};
</script>
