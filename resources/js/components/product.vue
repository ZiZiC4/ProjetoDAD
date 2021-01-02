<template>
  <div>
    <td v-if="$store.state.user.type == 'EM'"><a class="btn btn-xs btn-primary" 
          v-on:click.prevent="">Add new Product</a></td>

    <select v-model="searchByType">
       <option value="">Type of Product</option>
       <option value="hot dish">Hot Dish</option>
       <option value="cold dish">Cold Dish</option>
       <option value="drink">Drink</option>
       <option value="dessert">Dessert</option>
    </select>
   <input v-model="searchByName" type="text">
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
        <tr v-for="(product,index) in filterTerm" :key="index">
          <td>{{ product.name }}</td>
          <td>{{ product.type }}</td>
          <td>{{ product.photo }}</td>
          <td>{{ product.price }}</td>
          <td>{{ product.description }}</td>
          <td v-if="$store.state.user.type == 'C'"><a class="btn btn-xs btn-primary" 
          v-on:click.prevent="addProduct(product)">Add to shopping cart</a></td>
          <td v-if="$store.state.user.type == 'EM'"><a class="btn btn-xs btn-primary" 
          v-on:click.prevent="editProduct(product)">Edit</a></td>
          <td v-if="$store.state.user.type == 'EM'"><a class="btn btn-xs btn-danger" 
          v-on:click.prevent="deleteProduct(product)">Delete</a></td>
          


          

        <user-edit
      v-if="currentUser"
      :user="currentUser"
      @user-saved="saveUser"
      @user-canceled="cancelEdit"
    ></user-edit>

        </tr>
      </tbody>
    </table>
  </div>

  
</template>

<script>
import ProductEditComponent from "./editProduct";
export default {
    componets:{
      "product-edit": ProductEditComponent,

    },
    data:function(){
        return{
            products: [],
            searchByName: "",
            searchByType: ""
        }
    },

    methods:{
      editProduct: function(product){
      this.
    this.$emit('edit-product', product)
      },
    
      getMenu: function(){
        axios.get('api/products')
                .then(response => {
                    this.products = response.data.data
                })
      },
      addProduct: function(product){
        this.$prompt("Quantity(integer only):",1).then((quantity)=>{
          var quantidade = parseInt(quantity)
          //console.log(typeof quantidade)
          if(!Number.isInteger(quantidade)){
            this.$alert("It must be an Integer")
            return
          }else{
            var order = {
              prod: product,
              quant: quantidade
            }
            this.$store.commit('addProductToOrder',order)  
          }
        })
        
      }
    },
    computed: {
        filterTerm(){
          var produtos = this.products
          var nomeProduto = this.searchByName.toLocaleLowerCase()
          var tipoProduto = this.searchByType
          if(!nomeProduto && !tipoProduto){
            return produtos
          }
          if(nomeProduto){
            if(!tipoProduto){
              produtos = produtos.filter(function(item){
                if(item.name.toLowerCase().indexOf(nomeProduto)!=-1){
                  return item;
                }
              })
            }else{
              produtos = produtos.filter(function(item){
                if(item.name.toLowerCase().indexOf(nomeProduto)!=-1){
                  return item;
                }
              })
              produtos = produtos.filter(function(item){
                if(item.type.indexOf(tipoProduto)!=-1){
                  return item;
                }
              })
            }
             }else{
            produtos = produtos.filter(function(item){
                if(item.type.indexOf(tipoProduto)!=-1){
                  return item;
                }
              })
          }
          return produtos;
        }
    },
    mounted () {
      this.getMenu();
    }
}
</script>

<style>
.table {
  width: 75%;
  margin-left: auto;
  margin-right: auto;
  color: #212529;
}
</style>