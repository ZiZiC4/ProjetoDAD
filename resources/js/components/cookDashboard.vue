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
               <td>1</td>
               <td>2</td>
           </tbody>
       </table>
  </div>
</template>

<script>
import product from './product.vue'
export default {
  components: { product },

}
</script>

<style>

</style>