<template>
  <div>
    <td v-if="$store.state.user.type == 'EM'">
      <router-link to="/productCreate">Add Product</router-link>
    </td>

    <select v-model="searchByType">
      <option value="">Type of Product</option>
      <option value="hot dish">Hot Dish</option>
      <option value="cold dish">Cold Dish</option>
      <option value="drink">Drink</option>
      <option value="dessert">Dessert</option>
    </select>
    <input v-model="searchByName" type="text" />
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Name</th>
          <th>Type</th>
          <th>Photo</th>
          <th>Price</th>
          <th>Description</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(product, index) in filterTerm" :key="index">
          <td>{{ product.name }}</td>
          <td>{{ product.type }}</td>
          <td>{{ product.photo }}</td>
          <td>{{ product.price }}</td>
          <td>{{ product.description }}</td>
          <td v-if="$store.state.user.type == 'C'">
            <a
              class="btn btn-xs btn-primary"
              v-on:click.prevent="addProduct(product)"
              >Add to shopping cart</a
            >
          </td>
          <td v-if="$store.state.user.type == 'EM'">
            <a
              class="btn btn-xs btn-primary"
              v-on:click.prevent="editProduct(product)"
              >Edit</a
            >
          </td>
          <td v-if="$store.state.user.type == 'EM'">
            <a
              class="btn btn-xs btn-danger"
              v-on:click.prevent="deleteProduct(product)"
              >Delete</a
            >
          </td>
        </tr>
      </tbody>
    </table>

    <!--<product-list 
    :products="products" 
    :selected-product="currentProduct"
    @edit-product="editProduct"
    @delete-product="deleteProduct">
    </product-list>-->

    <div class="alert alert-success" v-if="showSuccess">
      <button type="button" class="close-btn" v-on:click="showSuccess = false">
        &times;
      </button>
      <strong>{{ successMessage }}</strong>
    </div>

    <product-edit
      v-if="currentProduct"
      :prod="currentProduct"
      @product-saved="saveProduct"
      @product-canceled="cancelEdit">

    </product-edit>
  </div>
</template>

<script>
import ProductEditComponent from "./editProduct";
export default {
  components: {
    "product-edit": ProductEditComponent,
  },
  data: function () {
    return {
      products: [],
      searchByName: "",
      searchByType: "",
      currentProduct: null,
      editingProduct: null,
      showSuccess: false,
      showFailure: false,
      successMessage: "",
      failMessage: "",
    };
  },

  methods: {
    editProduct: function (product) {
      this.currentProduct = Object.assign({}, product);
      this.editingProduct = true;
      this.showSuccess = false;
    },

    deleteProduct: function (product) {
      axios.delete("api/product/destroy/" + product.id).then((response) => {
        console.log(response);
        this.showSuccess = true;
        this.successMessage = "Product deleted with success";

      })
    },

    cancelEdit: function (product) {
      this.showSuccess = false
      Object.assign(this.currentProduct, product)
      this.currentProduct = null
    },

    getMenu: function () {
      axios.get("api/products").then((response) => {
        this.products = response.data.data;
      });
    },
    saveProduct: function (product) {
      this.showSuccess = true;
      this.successMessage = "Product Saved";
      Object.assign(this.currentProduct, product);
      this.currentProduct = null;
    },
    addProduct: function (product) {
      this.$prompt("Quantity(integer only):", 1).then((quantity) => {
        var quantidade = parseInt(quantity);
        //console.log(typeof quantidade)
        if (!Number.isInteger(quantidade)) {
          this.$alert("It must be an Integer");
          return;
        } else {
          var order = {
            prod: product,
            quant: quantidade,
          };
          this.$store.commit("addProductToOrder", order);
        }
      });
    },
  },
  watch: {
    selectedProduct: function (val) {
      this.editingProduct = this.selectedProduct;
    },
  },
  computed: {
    filterTerm() {
      var produtos = this.products;
      var nomeProduto = this.searchByName.toLocaleLowerCase();
      var tipoProduto = this.searchByType;
      if (!nomeProduto && !tipoProduto) {
        return produtos;
      }
      if (nomeProduto) {
        if (!tipoProduto) {
          produtos = produtos.filter(function (item) {
            if (item.name.toLowerCase().indexOf(nomeProduto) != -1) {
              return item;
            }
          });
        } else {
          produtos = produtos.filter(function (item) {
            if (item.name.toLowerCase().indexOf(nomeProduto) != -1) {
              return item;
            }
          });
          produtos = produtos.filter(function (item) {
            if (item.type.indexOf(tipoProduto) != -1) {
              return item;
            }
          });
        }
      } else {
        produtos = produtos.filter(function (item) {
          if (item.type.indexOf(tipoProduto) != -1) {
            return item;
          }
        });
      }
      return produtos;
    },
  },
  mounted() {
    this.getMenu();
  },
};
</script>

<style>
.table {
  width: 75%;
  margin-left: auto;
  margin-right: auto;
  color: #212529;
}
</style>