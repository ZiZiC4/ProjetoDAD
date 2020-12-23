<template>
  <div>
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
        <tr v-for="product in filterTerm" :key="product.id">
          <td>{{ product.name }}</td>
          <td>{{ product.type }}</td>
          <td>{{ product.photo }}</td>
          <td>{{ product.price }}</td>
          <td>{{ product.description }}</td>
          <td v-if="$store.state.user.type == 'C'"><a class="btn btn-xs btn-primary" 
          v-on:click.prevent="addProduct(product)">Add to shopping cart</a></td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
    data:function(){
        return{
            products: [],
            searchByName: "",
            searchByType: ""
        }
    },
    methods:{
      getMenu: function(){
        axios.get('api/products')
                .then(response => {
                    this.products = response.data.data
                })
      },
      addProduct: function(product){
        this.$store.commit('addProductToOrder',product)
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