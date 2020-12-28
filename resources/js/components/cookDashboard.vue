<template>
  <div>
      <h4>Order Informartion</h4>
      <table class="table table-striped">
        <th>Order ID:</th>
        <th>Client Name:</th>
        <th>Start time:</th>
        <th>Time Passed:</th>
      </table>
       <table class="table table-striped">
           <thead>
               <th>Product Name</th>
               <th>Product Description</th>
           </thead>
           <tbody>
               <td></td>
               <td></td>
           </tbody>
       </table>
  </div>
</template>

<script>
import product from './product.vue'
export default {
  data: function(){
    return{
            order: null
        }
  },
  methods: {
    getOrder: function(){

      axios.get('api/orders').then(response=> this.order = response.data.data)

    }
  },
  mounted(){
      this.getOrder();
  }

}
</script>

<style>

</style>