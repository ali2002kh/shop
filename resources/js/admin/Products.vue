<template>
    <div class="container d-flex">
        <router-link :to="{name: 'create-product'}" class="btn btn-primary">new product</router-link>
    </div>
    <div class="container mt-2">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">name</th>
                <th scope="col">price</th>
                <th scope="col">sold</th>
                <th scope="col">category</th>
                <th scope="col">reccomended</th>
                <th scope="col">count</th>
                <th scope="col">handle</th>
              </tr>
            </thead>
            <tbody>
                <tr v-for="p in products" :key="p.id">
                    <td>{{ p.name }}</td>
                    <td>{{ p.price }}</td>
                    <td>{{ p.sold }}</td>
                    <td>{{ p.category }}</td>
                    <td><i v-if="p.recommended" class="fa fa-check"></i></td>
                    <td>{{ p.count }}</td>
                    <td>
                        <router-link :to="{name: 'edit-product', params: {id: p.id}}" class="btn btn-dark m-1"><i class="fa fa-edit"></i></router-link>
                        <button @click.prevent="deleteProduct(p.id)" class="btn btn-danger m-1"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>

export default {
    data() {
        return {
            products: [],
        }
    },
    created() {
        axios.get('/api/products')
        .then(response => {
            this.products = response.data.data
        })
    },  
    methods: {
        async deleteProduct(product_id) {
            console.log('delete')
            axios.get(`/api/delete-product/${product_id}`)
            .then(response => {
                console.log(response)
                axios.get('/api/products')
                .then(response => {
                    this.products = response.data.data
                })
            })
        }
    },
}
</script>
