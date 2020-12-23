<template>
  <div>
      <h2>Shopping Cart:</h2>
      <h2>Client : {{ costumerName }}</h2>
      <table class="table table-striped">
           <thead>
               <th>Product Name</th>
               <th>Product Price</th>
               <th>Product Description</th>
           </thead>
           <tbody>
               <tr v-for="product in $store.state.orderProducts"
          :key="product.id">
                   <td>{{product.name}}</td>
                   <td>{{product.price}}</td>
                   <td>{{product.description}}</td>
                   <td>{{product.id}}</td>
                   <td><a class="btn btn-xs btn-primary" 
          v-on:click.prevent="removeProduct()">Remove From shopping cart</a></td>
               </tr>
           </tbody>
       </table>
       <button v-on:click.prevent="getPrice()">Calcular Preço</button>
       <h4>Total Price : {{ totalPrice }}</h4>
  </div>
</template>

<script>
export default {
    data: function(){
        return{
            costumerName: this.$store.state.user.name,
            totalPrice: 0
        }
    },
    methods:{
        getPrice: function(){
            this.$store.state.orderProducts.forEach(prod => {
                this.totalPrice += parseFloat(prod.price)
            });
        },
        removeProduct: function(){
            this.$store.commit('removeProductFromOrder')
            //console.log("hello")
        }
    },
    computed:{

    },
    mounted(){
    }
}
</script>

<style>

</style>