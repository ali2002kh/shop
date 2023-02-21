<template>
    <page-header></page-header>
    <div class="container d-grid">
        <div class="d-flex flex-wrap m-2 justify-content-between align-items-center" style="max-width:200px">
            <div class="justify-content-start">order code : </div>
            <div class="justify-content-end">{{ order.code }}</div>
        </div>
        <div class="d-flex flex-wrap m-2 justify-content-between align-items-center" style="max-width:200px">
            <div class="justify-content-start">status : </div>
            <div class="justify-content-end">{{ order.status }}</div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-12 my-1 d-flex" v-for="i in order.cart.items" :key="i.product_id">
                <div class="container-fluid d-flex align-items-center">
                    <img class="item-img me-3" src="" alt="">
                    <div class="d-grid">
                        <p class="lead mb-1">{{ i.product_name }}</p>
                        <p class="text-muted mb-1">{{ i.old_price }} toman</p>
                    </div>
                </div>
                <div class="d-grid justify-content-end align-items-center w-100">
                    <p class="text-muted m-2 text-center">{{ i.old_price * i.count }} toman</p>
                    <hr class="my-0">
                    <p class="text-muted m-2 text-center">count : {{ i.count }}</p>
                </div>
            </div>
            <br>
        <div class="d-flex flex-wrap justify-content-between align-items-center m-3">
            <div class="justify-content-start lead">total price : </div>
            <div class="justify-content-end lead">{{ order.final_price }} toman</div>
        </div>
    </div>
    <page-footer></page-footer>
</div>
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
            order: null,
        }
    },
    created() {
        axios.get(`/api/order/${this.$route.params.code}`)
        .then(response => {
            console.log(response.data.data)
            this.order = response.data.data
        })
    },  
}
</script>

<style scoped>

.item-img {
    width : 80px;
    height: 80px;
    border-radius: 10px;
}
</style>