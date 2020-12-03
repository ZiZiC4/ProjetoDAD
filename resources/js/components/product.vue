<template>
  <div>
   <input v-model="searchFor" type="text">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Name</th>
          <th>Type</th>
          <th>Photo</th>
          <th>Price</th>
          <th>Description</th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="product in products"
          :key="product.id"
        >
          <td>{{ product.name }}</td>
          <td>{{ product.type }}</td>
          <td>{{ product.photo }}</td>
          <td>{{ product.price }}</td>
          <td>{{ product.description }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
    data:function(){
        return{
            products: [],
            searchFor: ""
        }
    },
    methods:{
      getMenu: function(){
        axios.get('api/products')
                .then(response => {
                    this.products = response.data.data
                })
      }

    },
    computed: {
        filterTerm(){
          return this.products.filter(product => {
            return product.name.toLowerCase().includes(this.searchFor)
          })
        }
    },
    mounted () {
      this.getMenu();
    }
}
</script>