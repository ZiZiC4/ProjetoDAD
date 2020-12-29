<template>
  <div>

      <label for="toggle_button">
        <span v-if="isActive">Cook On</span>
        <span v-if="!isActive">Cook Off</span>
        <input type="checkbox" id="toggle_button" v-model="checkedValue">
      </label>
      <h4>Order Informartion</h4>
      
      <table class="table table-striped">
        <thead>
          <th>Cliente ID:</th>
          <th>Client Name:</th>
          <th>Start time:</th>
          <th>Time Passed:</th>
        </thead>
        <tbody v-if="order!=null">
          <tr>
            <td>{{order.client[0].id}}</td>
            <td>{{order.client[0].name}}</td>
            <td>{{order.order.opened_at}}</td>
            <td>{{order.order.opened_at-order.order.current_status}}</td>
          </tr>
        </tbody>
      </table>
       <table class="table table-striped">
           <thead>
               <th>Product Name</th>
               <th>Product Description</th>
               <th>Photo</th>
           </thead>
           <tbody v-if="order!=null">
             <tr v-for="(product,index) in order.items" :key="index">
               <td>{{product.product.name}}</td>
               <td>{{product.product.description}}</td>
               <td><img :src="'storage/products/' + product.product.photo_url" style="width:150px; height:150px; border-radius:50%; margin-bottom:25px; margin-right:25px; float:left;"></td>
             </tr>
           </tbody>
       </table>
      <div v-if="order!=null">
        <h5>Order notes:</h5>
        <p>{{order.order.notes}}</p>
      </div>
  </div>
</template>

<script>

export default {
  props:{
    defaultState:{
        type:Boolean,default:false
    }
  },
  data: function(){
    return{
            order: null,
            currentState:this.defaultState,
            checkbox:false,
        }
  },
  methods: {
    getOrder: function(){
      console.log(this.currentState)
      axios.get('api/orders')
      .then(response=>{
            this.order = response.data
            console.log(this.order)
            //this.order = response.data.data
        })

    }
  },
  computed:{
      isActive(){
        return this.currentState;
      },
      checkedValue: {
        get() {
            return this.currentState
        },
        set(newValue) {
            this.currentState = newValue;
        }
      }
  },
  mounted(){
      this.getOrder()
  }

}
</script>

<style>

</style>