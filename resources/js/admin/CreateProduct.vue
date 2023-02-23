<template>
    <div class="container">
        <form class="row">
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
                        <input type="text" class="form-control m-1" v-model="d['key']">
                        :
                        <input type="text" class="form-control m-1" v-model="d['value']">
                    </div>
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
            ]
        }
    },
    created() {
        axios.get('/api/categories')
        .then(response => {
            this.categories = response.data.data
        })
    },
    methods: {
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
            await axios.post('/store-product', {
                name: this.name,
                description: this.description,
                price: this.price,
                count: this.count,
                category: this.category,
                details: this.details
            }).then(response => {
                console.log(response.data)
            })
        },
    }
}

</script>