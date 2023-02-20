<template>
    <page-header></page-header>
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-5 my-3">
                <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                    <!-- @foreach ($product->images() as $i)
                    <div class="carousel-item active">
                        <img src="" class="d-block w-100" alt="...">
                    </div>
                    @endforeach -->
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col-sm-3 my-3 text-center">
                <p class="display-6">{{ product.name }}</p>
                <p class="lead">{{ product.price }} toman</p>
                <p class="text-muted">number remaining : {{ product.count }}</p>
                <p class="text-muted">category : {{ product.category }}</p>
                <div class="m-1 d-grid">
                    <button type="submit" class="btn btn-primary my-1"
                    @click.prevent="add"
                    >add to cart</button>
                    <button type="submit" class="btn btn-danger my-1"
                    v-if="inCart"
                    @click.prevent="remove"
                    >remove from cart</button>
                </div>
                <p class="lead" v-if="hasCart">in the cart : {{ count_in_cart }}</p>   
            </div>
            <div class="col-sm-3 m-4">
                <p>details : </p>
                <ul>
                    <!-- @foreach (json_decode($product->details, true) as $key => $value)
                    <li class="text-muted">{{ $key }} : {{ $value }}</li>
                    @endforeach -->
                </ul>
                <hr>
                <p>description : </p>
                <p class="text-muted">{{ product.description }}</p>
            </div>
        </div>
        <popular></popular>
    </div>
    <page-footer></page-footer>
</template>

<script>

import Popular from "../layouts/Popular"
import PageHeader from "../layouts/PageHeader"
import PageFooter from "../layouts/PageFooter"

export default {
    components: {
        Popular,
        PageHeader,
        PageFooter,
    },
    data() {
        return {
            product: null,
            hasCart: false,
            inCart: false,
            count_in_cart: 0,
        }
    },
    created() {
        axios.get('/api/user')
        .then(response => {
            this.hasCart = response.data.data.has_cart
        })
        axios.get(`/api/product/${this.$route.params.id}`)
        .then(response => {
            console.log(response.data.data)
            this.product = response.data.data
            if (this.hasCart) {
                this.count_in_cart = this.product.count_in_cart
                if (this.count_in_cart > 0) {
                    this.inCart = true
                }
            }
        })
    },  
    methods: {
        async add () {
            console.log('add')
            axios.get(`/api/add-to-cart/${this.$route.params.id}`)
            .then(response => {
                console.log("count in cart : "+response.data)
                this.count_in_cart = response.data
            }).catch(error => {
                if (error.response && 
                error.response.status && 
                error.response.status == 401) {
                    console.log('401')
                    this.$router.push('/login')
            };
            })
            if (this.count_in_cart > 0) {
                this.inCart = true
            }
        },
        async remove () {
            console.log('remove')
            axios.get(`/api/remove-from-cart/${this.$route.params.id}`)
            .then(response => {
                console.log("count in cart : "+response.data)
                this.count_in_cart = response.data
            })
            if (this.count_in_cart == 0) {
                this.inCart = false
            }
        }
    },
}
</script>