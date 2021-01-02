<template>
  <div>
      <label for="toggle_button">
        <span v-if="isActive">DeliveryMan On</span>
        <span v-if="!isActive">DeliveryMan Off</span>
        <input type="checkbox" id="toggle_button" v-model="checkedValue">
      </label>
      <button v-on:click.prevent="finishDelivery()">Delivered</button>
      <div v-if="orders">
        <table class="table table-striped">
            <thead>
                <th>Order ID:</th>
                <th>Client Name:</th>
                <th>Ready time:</th>
                <th v-if="currentState">Choose Order</th>
            </thead>
            <tbody v-if="orders!=null">
                <tr v-for="(order,index) in orders" :key="index">
                <td>{{order.id}}</td>
                <td>{{names[index]}}</td>
                <td>{{order.current_status_at}}</td>
                <td  v-if="currentState"><a class="btn btn-xs btn-primary" 
            v-on:click.prevent="selectOrder(order)">Add to shopping cart</a></td>
                </tr>
            </tbody>
            </table>
        </div>
        <div v-if="selectedOrder && orderUserInfo && orderPrductsInfo">
            <table class="table table-striped">
            <thead>
                <th>Order ID:</th>
                <th>Name:</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Photo</th>
                <th>Delivery Start</th>
                <th>Elapsed Time</th>
                <th>Notes</th>
            </thead>
            <tbody>
                <tr>
                <td>{{selectedOrder.id}}</td>
                <td>{{orderUserInfo.name}}</td>
                <td>{{orderUserInfo.customer[0].address}}</td>
                <td>{{orderUserInfo.customer[0].phone}}</td>
                <td>{{orderUserInfo.email}}</td>
                <td><img :src="'storage/fotos/' + orderUserInfo.photo_url" style="width:150px; height:150px; border-radius:50%; margin-bottom:25px; margin-right:25px; float:left;"></td>
                <td>{{selectedOrder.current_status_at}}</td>
                <td>Falta fazer</td>
                <td>{{selectedOrder.notes}}</td>
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
                <tbody v-if="orderPrductsInfo!=null">
                <tr v-for="(product,index) in orderPrductsInfo" :key="index">
                    <td>{{product.product.name}}</td>
                    <td>{{product.product.description}}</td>
                    <td>{{product.quantity}}</td>
                    <td><img :src="'storage/products/' + product.product.photo_url" style="width:150px; height:150px; border-radius:50%; margin-bottom:25px; margin-right:25px; float:left;"></td>
                </tr>
                </tbody>
            </table>
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
                orders: null,
                names: null,
                currentState:this.defaultState,
                checkbox:false,
                selectedOrder:null,
                orderUserInfo:null,
                orderPrductsInfo:null,
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

                    this.orderPrductsInfo = response.data.items;
                    this.orderUserInfo = response.data.userInfo;
                    this.orders=null
                    this.currentState=false;
                })
        },
        finishDelivery: function(){
            axios.put('api/delivery/orders/'+ this.selectedOrder.id,{id: this.$store.state.user.id}).then(response =>{
                console.log(response)
                this.currentState=true
                this.selectedOrder = null
                this.orderUserInfo = null
                this.orderPrductsInfo = null
                this.getOrders();
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
                var id = this.$store.state.user.id
                axios.put('api/delivery/'+id,{state: this.currentState})
                    .then(response=>{
                        console.log(response)
                    })
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