<template>
    <page-header></page-header>
    <div class="container my-2 d-grid">
        <div class="row">
            <div class="col-sm-12 rounded-3 m-1">
                <p class="lead">Checkout</p>
                <hr>
            </div>
            <div class="col-sm-11 rounded-3 m-1 px-0">
                <div class="col-sm-12 my-1 d-flex" 
                v-for="i in cart.items" :key="i.product_id">
                    <div class="container-fluid d-flex align-items-center">
                        <img class="item-img me-3" src="" alt="">
                        <div class="d-grid">
                            <p class="lead mb-1">{{ i.product_name }}</p>
                            <p class="text-muted mb-1">{{ i.product_price }} toman</p>
                        </div>
                    </div>
                    <div class="d-grid justify-content-end align-items-center w-100">
                        <p class="text-muted m-2 text-center">{{ i.product_price * i.count }} toman</p>
                        <hr class="my-0">
                        <p class="text-muted m-2 text-center">count : {{ i.count }}</p>
                    </div>
                </div>
                <br>
            </div>

            <div class="col-sm-6 rounded-3 m-1 px-0">
                <!-- @include('client.layouts.error') -->
                <form id="buy-form" action="{{ route('buy') }}" method="Post">
                    <div class="d-flex justify-content-between align-items-center m-1">
                        <select class="form-select form-select-lg m-1 text-muted"  
                        style="font-size:16px" name="province" id="province"
                        v-model="province" @change="updateCities"
                        >
                            <option disabled value="">province</option>
                            <option v-for="p in provinces" :key="p.id" value="{{ p.id }}">
                                {{ p.name }}
                            </option>
                        </select>
                        <select name="city" class="form-select form-select-lg m-1 text-muted"  
                        style="font-size:16px" id="city"
                        v-model="city"
                        >
                            <option value="">city</option>
                        </select>
                    </div>
                    <div class="m-1">
                        <label for="zip_code" class="form-label">zip code</label>
                        <input type="text" class="form-control" id="zip_code" 
                        name="zip_code" v-model="zip_code"
                        >
                    </div>
                    <div class="m-1">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" 
                        name="address" v-model="address"
                        >
                    </div>
                    <div class="m-1">
                        <label for="telephone" class="form-label">Telephone</label>
                        <input type="text" class="form-control" id="telephone" 
                        name="telephone" v-model="telephone"
                        >
                    </div>
                </form>
            </div>

            <div class="col-sm-5 rounded-3 m-1">
                <div class="d-flex flex-wrap m-2 justify-content-between align-items-center">
                    <div class="justify-content-start">Cart total price : </div>
                    <div class="justify-content-end">{{ cart.total_price }} toman</div>
                </div>
                <div class="d-flex flex-wrap m-2 justify-content-between align-items-center">
                    <div class="justify-content-start">Tax (9%) : </div>
                    <div class="justify-content-end">{{ cart.total_price * 9/100 }} toman</div>
                </div>
                <div class="d-flex flex-wrap m-2 justify-content-between align-items-center">
                    <div class="justify-content-start">Shipping cost : </div>
                    <div class="justify-content-end">30000 toman</div>
                </div>
                <hr class="m-2">
                <div class="d-flex flex-wrap m-2 justify-content-between align-items-center">
                    <div class="justify-content-start">Payment amount : </div>
                    <div class="justify-content-end">{{ cart.total_price * 109/100 + 30000 }} toman</div>
                </div>
                <div class="m-1 d-grid">
                    <button type="submit" 
                    class="btn btn-dark m-3"
                    @click.prevent="pay"
                    >Pay</button>
                </div>
            </div>
        </div>
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
            provinces: [],
            cities: [],
            province: null,
            city: null,
            zip_code: null,
            telephone: null,
            address: null,
        }
    },
    created() {
        axios.get('/api/cart')
        .then(response => {
            console.log(response.data.data)
            this.cart = response.data.data
        })
        axios.get('/api/provinces')
        .then(response => {
            console.log(response.data)
            this.provinces = response.data
        })
    },  
    methods: {
        async pay() {
            
        },
        async updateCities() {
            axios.post('/api/cities', {
                province: this.province
            })
            .then(response => {
                console.log(response)
            })
        }
    }
}
</script>

<style scoped>

.item-img {
    width : 80px;
    height: 80px;
    border-radius: 10px;
}
</style>