<template>
    <hr class="mt-5">
    <div class="row">
        <div class="col-sm-12">
            <p class="lead">newest products</p>
        </div>
        <div class="col-sm-4" v-for="n in newest" :key="n.id">
            <div class="card mb-10">
                <img :src="n.image" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ n.name }}</h5>
                    <p class="card-text">{{ n.price }} toman</p>
                    <router-link :to="{name: 'product', params: {id: n.id}}" class="btn btn-primary">details</router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    data() {
        return {
            newest: null,
        }
    },
    created() {
        axios.get('/api/newest')
        .then(response => {
            console.log(response.data.data)
            this.newest = response.data.data;
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