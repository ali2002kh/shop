<template>
    <page-header></page-header>
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-12 m-3">
                <p class="display-6">{{ category_name }} category</p>
            </div>
            <div class="col-sm-4" v-for="p in products" :key="p.id">
                <div class="card mb-10">
                    <img src="" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ p.name }}</h5>
                        <p class="card-text">{{ p.price }} toman</p>
                        <router-link :to="{name: 'product', params: {id: p.id}}" class="btn btn-primary">details</router-link>
                    </div>
                </div>
            </div>
        </div>
        <nav aria-label="Page navigation example" v-if="pagination">
            <ul class="pagination ms-3">
                <li class="page-item"><button v-if="hasPrev" @click.prevent="prev" class="page-link">Previous</button></li>
                <li class="page-item"><button class="page-link">{{ page }}</button></li>
                <li class="page-item"><button v-if="hasNext" @click.prevent="next" class="page-link">Next</button></li>
            </ul>
        </nav>
    </div>
    <page-footer></page-footer>
</template>

<script>

import PageHeader from "../layouts/PageHeader"
import PageFooter from "../layouts/PageFooter"

export default {
    components: {
        PageHeader,
        PageFooter,
    },
    data() {
        return {
            category_name: this.$route.params.name,
            numberOfProducts: 0,
            products: [],
            page: 0,
            hasNext: true,
            hasPrev: false,
            page_size: 0,
        }
    },
    computed: {
        pagination() {
            return this.hasNext || this.hasPrev
        },
    },
    created() {
        axios.get(`/api/category/${this.$route.params.name}/${this.page}`)
        .then(response => {
            console.log(response.data)
            this.numberOfProducts = response.data.count
            this.page_size = response.data.page_size
        })
        this.page++
        this.getProducts()
    },  
    methods: {
        async getProducts() {
            axios.get(`/api/category/${this.$route.params.name}/${this.page}`)
            .then(response => {
                console.log(response.data.data)
                this.products = response.data.data
                if (this.products.length < this.page_size || 
                    ((this.page - 1) * this.page_size) + this.products.length == this.numberOfProducts) {
                        console.log(this.products.length)
                        this.hasNext = false
                }
            })
        },
        async next() {
            this.page++
            this.getProducts()
            this.hasPrev = true
        },
        async prev() {
            this.page--
            this.getProducts()
            this.hasNext = true
            if (this.page <= 1) {
                this.hasPrev = false
            }
        },
    },
}
</script>

<style scoped>
    .card {
        margin : 10px;
    }
    .card-img-top {
        max-height: 400px;
        width: auto;
    }
</style>
