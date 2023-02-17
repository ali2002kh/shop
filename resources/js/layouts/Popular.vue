<template>
    <hr class="mt-5">
    <div class="row">
        <div class="col-sm-12">
            <p class="lead">popular products</p>
        </div>
        <div class="col-sm-4" v-for="p in popular" :key="p.id">
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
</template>

<script>

export default {
    data() {
        return {
            popular: null,
        }
    },
    created() {
        axios.get('/api/popular')
        .then(response => {
            console.log(response.data.data)
            this.popular = response.data.data;
        });
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