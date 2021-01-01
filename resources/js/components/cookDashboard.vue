<template>
  <div>

      <label for="toggle_button">
        <span v-if="isActive">Cook On</span>
        <span v-if="!isActive">Cook Off</span>
        <input type="checkbox" id="toggle_button" v-model="checkedValue">
      </label>
      <div>
        <h4>Order Informartion</h4>
        <button v-on:click.prevent="orderFinish()">Order Finished</button>
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
                <th>Quantity</th>
                <th>Photo</th>
            </thead>
            <tbody v-if="order!=null">
              <tr v-for="(product,index) in order.items" :key="index">
                <td>{{product.product.name}}</td>
                <td>{{product.product.description}}</td>
                <td>{{product.quantity}}</td>
                <td><img :src="'storage/products/' + product.product.photo_url" style="width:150px; height:150px; border-radius:50%; margin-bottom:25px; margin-right:25px; float:left;"></td>
              </tr>
            </tbody>
        </table>
        <div v-if="order!=null">
          <h5>Order notes:</h5>
          <p>{{order.order.notes}}</p>
        </div>
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
      if(this.currentState){
        axios.get('api/orders')
        .then(response=>{
              if(response.data){
                this.order = response.data
              }else{
                this.order = null
                this.$toasted.show('No orders in line!!!', { type: 'info' })
              }
              //this.order = response.data.data
          })
      }else{
        this.$toasted.show('Orders OFF', { type: 'info' })
      }

    },
    orderFinish: function(){
        axios.put('api/orders/'+ this.order.order.id,{type: this.$store.state.user.type}).then(response =>{
            console.log(response)
            this.order=null
            this.getOrder()
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
            var id = this.$store.state.user.id
            console.log(this.currentState)
            axios.put('api/cook/'+id,{state: this.currentState})
                  .then(response=>{
                    console.log(response)
                    if(this.currentState){
                       this.getOrder()
                    }
                  })
        }
      }
  },
  mounted(){
      //this.getOrder()
  }

}
</script>

<style>

</style>