<template>
  <div v-if="orders">
        <table class="table table-striped">
            <thead>
                <th>Order ID:</th>
                <th>Status</th>
                <th>Opened At:</th>
                <th>Notes:</th>
            </thead>
            <tbody >
                <tr v-for="(order,index) in orders" :key="index">
                <td>{{order.id}}</td>
                <td>
                    <p v-if="order.status=='H'">Holding</p>
                    <p v-if="order.status=='P'">Preparing</p>
                    <p v-if="order.status=='R'">Food is Ready</p>
                    <p v-if="order.status=='T'">Delivering</p>
                    <p v-if="order.status=='D'">Delivered</p>
                    <p v-if="order.status=='C'">Canceled</p>
                </td>
                <td>{{order.opened_at}}</td>
                <td>{{order.notes}}</td>
                <td><a class="btn btn-xs btn-primary" 
          v-on:click.prevent="showDetails(order)">Details</a></td>
                </tr>
            </tbody>
        </table>
        <div v-if="orderInfo">
            <table class="table table-striped">
                <thead>
                    <th>Name:</th>
                    <th>Description</th>
                    <th>Photo:</th>
                    <th>Price(per unit):</th>
                </thead>
                <tbody >
                    <tr v-for="(product,index) in orderInfo" :key="index">
                    <td>{{product.product.name}}</td>
                    <td>{{product.product.description}}</td>
                    <td><img v-bind:src="'/storage/products/'+product.product.photo_url"
            style="
              width: 150px;
              height: 150px;
              border-radius: 50%;
              margin-bottom: 25px;
              margin-right: 25px;
              float: left;
            "
          /></td>
                    <td>{{product.product.price}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    data: function(){
        return{
                orders:null,
                orderInfo:null
            }
    },
    methods:{
        getOrderHistory: function(){
            axios.get('/api/order/user/'+ this.$store.state.user.id).then(response=>{
                console.log(response)
                this.orders = response.data
            })
        },
        showDetails: function(order){
            axios.get('api/details/order/'+order.id).then(response =>{
                this.orderInfo = response.data
            })
        }
    },
    mounted (){
        this.getOrderHistory();
    }
}
</script>

<style>

</style>