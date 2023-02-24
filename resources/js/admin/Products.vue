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
                        <button type="button" class="btn btn-secondary m-1" data-bs-toggle="modal" :data-bs-target="`#addImage_${p.id}`"><i class="fa fa-image"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div v-for="p in products" :key="p.id"
     class="modal fade" :id="`addImage_${p.id}`" tabindex="-1" :aria-labelledby="`addImageLabel_${p.id}`" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" :id="`addImageLabel_${p.id}`">Add new Image</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" v-if="hasError">
                        <ul>
                            <li v-for="e in errors" :key="e">{{ e[0] }}</li>
                        </ul>
                    </div>
                    <div class="alert alert-success" v-if="success">{{ message }}</div>
                    <form>
                        <input class="form-control m-1" type="file" id="image" @change="onFileChange($event)">
                        <div class="m-1 d-grid">
                            <button type="submit" class="btn btn-dark m-3" 
                            @click.prevent="addImage(p.id)"
                            >Add image</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    data() {
        return {
            products: [],
            hasError: false,
            errors: [],
            success: false,
            message: '',
            file: '',
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
        },

        async onFileChange(event) {
            this.success = false
            this.hasError = false
            this.file = event.target.files[0]
        },
        
        async addImage (product_id) {
            this.success = false
            this.hasError = false
            let fd = new FormData()

            fd.append('file', this.file)
            fd.append('_method', 'POST')

            await axios.post(`/api/add-product-image/${product_id}`, fd,
                {
                    headers: {
                    'Content-Type': `multipart/form-data; boundary=${fd._boundary}`
                    }
                } 
            ).then(async response => {
                this.success = true
                this.message = response.data.message
                this.file = ''
            }).catch(error => {
                if (error.response && error.response.status) {
                    this.hasError = true
                    console.log(error.response.data)
                    if (error.response.status == 422) {
                        this.errors = error.response.data.errors
                    } else if (error.response.status == 421) {
                        var e = []
                        e[0] = error.response.data.message
                        this.errors[0] = e
                        console.log(this.errors)
                    }     
                } 
            })
        }
    },
}
</script>
