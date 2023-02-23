<template>
    <div class="container">
        <form class="row">
            <div class="col-sm-12">
                <div class="alert alert-danger" v-if="hasError">
                    <ul>
                        <li v-for="e in errors" :key="e">{{ e[0] }}</li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="m-1">
                    <label for="name" class="form-label">Product name</label>
                    <input type="text" class="form-control" 
                    id="name" name="name" v-model="name"
                    >
                </div>
                <div class="m-1">
                    <label for="description" class="form-label">Description</label>
                    <textarea id="description" class="form-control" name="description" v-model="description"></textarea>
                </div>
                <div class="row my-1">
                    <div class="col-sm-3 m-1">
                        <label for="count" class="form-label">Count</label>
                        <input type="number" class="form-control" id="count" name="count"
                        v-model="count"
                        >
                    </div>
                    <div class="col-sm-7 m-1">
                        <label for="price" class="form-label">Price (toman)</label>
                        <input type="number" class="form-control" id="price" name="price"
                        v-model="price"
                        >
                    </div>
                </div>
                <div class="m-1">
                    <label for="category" class="form-label">Category</label>
                    <select class="form-control w-50" id="category" name="category" v-model="category">
                        <option disabled value="">choose category</option>
                        <option v-for="c in categories" :key="c.id" :value="c.id">{{ c.name }}</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="m-1">
                    <label for="details" class="form-label">Product details</label>
                    <div class="m-1 d-flex">
                        <button type="submit" class="btn btn-primary m-1" style="width:40px" 
                        @click.prevent="addProperty"
                        >+</button>
                        <button type="submit" class="btn btn-danger m-1" style="width:40px" 
                        @click.prevent="removeProperty"
                        >-</button>
                    </div>
                    <div class="d-flex justify-content-between align-items-center m-1"
                        v-for="d in details" :key="d">
                        <input type="text" class="form-control my-1 mx-4" v-model="d['key']">
                        :
                        <input type="text" class="form-control my-1 mx-4" v-model="d['value']">
                    </div>
                </div>
                <div class="m-1">
                    <label for="image" class="form-label">Product main image</label>
                    <input class="form-control" type="file" id="image" @change="onFileChange($event)">
                </div>
            </div>
            <div class="m-1 d-grid">
                <button type="submit" class="btn btn-dark m-3" 
                @click.prevent="create"
                >Create</button>
            </div>
        </form>
    </div>
</template>

<script>

export default {
    data() {
        return {
            name: null,
            description: null,
            price: null,
            count: null,
            category: null,
            categories: null,
            details: [
                {
                    key: null,
                    value: null
                }
            ],
            hasError: false,
            errors: [],
            file: '',
            product_id: null,
        }
    },
    created() {
        axios.get('/api/categories')
        .then(response => {
            this.categories = response.data.data
        })
    },
    methods: {
        async onFileChange(event) {
            this.file = event.target.files[0]
        },

        async addProperty() {
            this.details.push({
                key: null,
                value: null
            })
        },
        async removeProperty() {
            this.details.pop()
        },
        async create() {
            console.log(this.details)

            let fd = new FormData()

            fd.append('name', this.name ?? '')
            fd.append('description', this.description ?? '')
            fd.append('price', this.price ?? '')
            fd.append('count', this.count ?? '')
            fd.append('category', this.category ?? '')
            fd.append('file', this.file)
            fd.append('_method', 'POST')

            await axios.post('/api/store-product', fd,
                {
                    headers: {
                    'Content-Type': `multipart/form-data; boundary=${fd._boundary}`
                    }
                } 
            ).then(async response => {
                this.product_id = response.data
                await axios.post(`/api/store-product-details/${this.product_id}`, {
                    details: this.details
                }).then(response => {
                    this.$router.push('/admin/products')
                })
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
        },
    }
}

</script>