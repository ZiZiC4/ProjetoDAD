<template>
  <div>
      <h2>Shopping Cart:</h2>
      <h2>Client : {{ costumerName }}</h2>
      <table class="table table-striped">
           <thead>
               <th>Product Name</th>
               <th>Product Price</th>
               <th>Product Description</th>
               <th>Quant</th>
               <th>Sub.Total</th>
           </thead>
           <tbody>
               <tr v-for="(product,index) in $store.state.orderProducts"
          :key="index">
                   <td>{{product.prod.name}}</td>
                   <td>{{product.prod.price}}</td>
                   <td>{{product.prod.description}}</td>
                   <td>{{product.quant}}</td>
                   <td>{{parseFloat(product.prod.price*product.quant).toFixed(2)}}</td>
                   <td><a class="btn btn-xs btn-primary" 
          v-on:click.prevent="removeProduct(product.prod.id)">Remove From shopping cart</a></td>
               </tr>
           </tbody>
       </table>
       <div>
           <button v-on:click.prevent="postOrder()">Confirm Order</button>
           <button v-on:click.prevent="getPrice()">Calcular Preço(temporario)</button>
           <h4>Total Price : {{ totalPrice }}</h4>
           <button v-on:click.prevent="clearCart()">Clear Order</button>
       </div>
       
  </div>
</template>

<script>
export default {
    data: function(){
        return{
            costumerName: this.$store.state.user.name,
            totalPrice: parseFloat(0)
        }
    },
    methods:{
        getPrice: function(){

            for(const idx in this.$store.state.orderProducts){
               this.totalPrice += parseFloat(this.$store.state.orderProducts[idx].prod.price*this.$store.state.orderProducts[idx].quant).toFixed(2) 
           }
            //this.$store.state.orderProducts.forEach(prod => {
            //    this.totalPrice += parseFloat(prod.price)
            //});
        },
        removeProduct: function(id){
            //console.log(id)
            this.$store.commit('removeProductFromOrder',id)
            //console.log("hello")
        },
        clearCart: function(){
            this.$confirm("Do you wish to remover your order?").then(()=>{
                this.$store.commit('clearOrder')
            })
            
        },
        postOrder: function(){
            this.$prompt("Notes (Optional):","No notes to add").then((text)=>{
                //console.log(this.costumerName)
                axios.post('api/orders',{ customer_id: this.$store.state.user.id, products: this.$store.state.orderProducts,notes:text})
                     .then(response =>{
                                console.log(response.data);
                                this.clearCart();
                            })
            })
        }
    },
    computed:{

    },
    mounted(){
        this.getPrice();
    }
}
</script>

<style>

</style>