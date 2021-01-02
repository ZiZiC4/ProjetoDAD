<template>
  <div v-if="orders">
        <table class="table table-striped">
            <thead>
                <th>Order ID:</th>
                <th>Status</th>
                <th>Opened At:</th>
                <th>Notes:S</th>
                <th v-if="currentState">Choose Order</th>
            </thead>
            <tbody >
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
</template>

<script>
export default {
    data: function(){
        return{
                order:null,
            }
    },
}
</script>

<style>

</style>