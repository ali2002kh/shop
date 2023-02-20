<template>
    <page-header></page-header>
    <div class="container my-5">
        <div class="row" v-if="hasCart">
            <div class="col-sm-12 my-1 d-flex" v-for="i in cart.items" :key="i.product_id">
                <div class="container-fluid d-flex">
                    <router-link :to="{name: 'product', params: {id: i.product_id}}">
                        <img class="item-img me-3" src="" alt="">
                    </router-link>
                    <div class="d-grid">
                        <p class="lead mb-1">{{ i.product_name }}</p>
                        <p class="text-muted mb-1">{{ i.product_price }} toman</p>
                    </div>
                </div>
                <div class="d-grid justify-content-end align-items-center w-100">
                    <p class="text-muted mb-1 text-center">{{ i.product_price * i.count }} toman</p>
                    <hr class="my-0">
                    <p class="text-muted mb-1 text-center">count : {{i.count }}</p>
                </div>
                <div class="my-1 mx-2 d-grid">
                    <button type="submit"
                    class="btn btn-primary my-1"
                    @click.prevent="add(i.product_id)"
                    >+</button>
                    <button type="submit"
                    class="btn btn-danger my-1"
                    @click.prevent="remove(i.product_id)"
                    >
                    <i v-if="i.count_one" class="fa fa-trash"></i>
                    <i v-else>-</i>
                    </button>
                </div>
            </div>
            <hr>
            <div class="d-flex flex-wrap justify-content-between align-items-center">
                <div class="justify-content-start lead">total price : </div>
                <div class="justify-content-end lead">{{ cart.total_price }} toman</div>
            </div>
        </div>
        <div class="m-1 d-grid" v-if="hasCart">
            <a href="" class="btn btn-dark m-3">Continue buying process</a>
        </div>
        <p v-else class="lead text-center">Cart is empty</p>
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
            cart: null,
            hasCart: false,
        }
    },
    created() {
        axios.get('/api/user')
        .then(response => {
            this.hasCart = response.data.data.has_cart
            axios.get('/api/cart')
            .then(response => {
                console.log(response.data.data)
                this.cart = response.data.data
            })
        })
    },  
    methods: {
        async add (product_id) {
            console.log('add')
            axios.get('/api/user')
            .then(response => {
                this.hasCart = response.data.data.has_cart
                axios.get(`/api/add-to-cart/${product_id}`)
                .then(response => {
                    console.log("count in cart : "+response.data)
                    axios.get('/api/cart')
                    .then(response => {
                        console.log(response.data.data)
                        this.cart = response.data.data
                    })
                })
            })
        },
        async remove (product_id) {
            console.log('remove')
            axios.get('/api/user')
            .then(response => {
                this.hasCart = response.data.data.has_cart
                axios.get(`/api/remove-from-cart/${product_id}`)
                .then(response => {
                    console.log("count in cart : "+response.data)
                    axios.get('/api/cart')
                    .then(response => {
                        console.log(response.data.data)
                        this.cart = response.data.data
                    })
                })
            })
        }
    },
}
</script>