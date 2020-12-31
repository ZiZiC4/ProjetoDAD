<template>
  <div>
      <label for="toggle_button">
        <span v-if="isActive">DeliveryMan On</span>
        <span v-if="!isActive">DeliveryMan Off</span>
        <input type="checkbox" id="toggle_button" v-model="checkedValue">
      </label>
      <table class="table table-striped">
          <thead>
            <th>Order ID:</th>
            <th>Client Name:</th>
            <th>Ready time:</th>
          </thead>
          <tbody v-if="orders!=null">
            <tr v-for="(order,index) in orders" :key="index">
              <td>{{order.id}}</td>
              <td>{{names[index]}}</td>
              <td>{{order.current_status_at}}</td>
              <td><a class="btn btn-xs btn-primary" 
          v-on:click.prevent="selectOrder(order)">Add to shopping cart</a></td>
            </tr>
          </tbody>
        </table>
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
                orders: null,
                names: null,
                currentState:this.defaultState,
                checkbox:false,
                selectedOrder:null,
            }
    },
    methods:{
        getOrders: function(){
            axios.get('api/delivery/orders').then(response => {
                //console.log(response.data)
                this.orders=response.data.orders
                this.names= response.data.clientInfo
                console.log(this.orders)
                console.log(this.names)
            })
        },
        selectOrder: function(order){
            this.selectedOrder = order;
            axios.put('api/orders/'+this.selectedOrder.id,{type:this.$store.state.user.type, id:this.$store.state.user.id })
                .then(response => {
                    console.log(response)
                })
        },

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
                console.log(this.currentState)
            }
        }
    },
    mounted(){
        this.getOrders();
    }

}
</script>

<style>

</style>