<template>
    <div class="container m-2">
        <label for="newName" class="form-label mb-0 lead">New category</label>
        <div class="alert alert-danger" v-if="newHasError">
            <ul>
                <li v-for="e in newErrors" :key="e">{{ e[0] }}</li>
            </ul>
        </div>
        <form class="d-flex justify-content-between align-items-center" style="width:300px">
            <input type="text" v-model="newName" class="form-control" id="newName" name="newName">
            <div class="m-1">
                <button type="submit" class="btn btn-primary m-3" 
                @click.prevent="addCategory"
                >Add</button>
            </div>
        </form>
    </div>
    <div class="container mt-2">
        <p class="lead">Categories</p> 
        <table class="table">
            <thead>
              <tr>
                <th scope="col">name</th>
                <th scope="col">number of products</th>
                <th scope="col">handle</th>
              </tr>
            </thead>
            <tbody>
                <tr v-for="c in categories" :key="c.id">
                    <td>{{ c.name }}</td>
                    <td>{{ c.numberOfProducts }}</td>
                    <td>
                        <button @click.prevent="deleteCategory(c.id)" class="btn btn-danger m-1"><i class="fa fa-trash"></i></button>
                        <button type="button" class="btn btn-dark m-1" data-bs-toggle="modal" :data-bs-target="`#editCategory_${c.id}`" @click="close"><i class="fa fa-edit"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div v-for="c in categories" :key="c.id"
     class="modal fade" :id="`editCategory_${c.id}`" tabindex="-1" :aria-labelledby="`editCategoryLabel_${c.id}`" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" :id="`editCategoryLabel_${c.id}`">Edit category name</h1>
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
                        <input type="text" v-model="name" class="form-control" id="name" name="name">
                        <div class="m-1 d-grid">
                            <button type="submit" class="btn btn-dark m-3" 
                            @click.prevent="updateCategory(c.id)"
                            >Update category</button>
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
            name: null,
            categories: [],
            hasError: false,
            errors: [],
            success: false,
            message: null,
            newName: null,
            newHasError: false,
            newErrors: [],
        }
    },
    created() {
        axios.get('/api/categories')
        .then(response => {
            this.categories = response.data.data
        })
    },  
    methods: {
        async deleteCategory(category_id) {
            console.log('delete')
            axios.get(`/api/delete-category/${category_id}`)
            .then(response => {
                console.log(response)
                axios.get('/api/categories')
                .then(response => {
                    this.categories = response.data.data
                })
            })
        },

        async updateCategory (category_id) {
            this.success = false
            this.hasError = false

            await axios.post(`/api/update-category/${category_id}`, {
                name : this.name
            }).then(async response => {
                this.success = true
                this.message = response.data.message
                axios.get('/api/categories')
                .then(response => {
                    this.categories = response.data.data
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
        
        async addCategory () {
            this.newHasError = false
            await axios.post('/api/create-category', {
                name: this.newName
            }).then(response => {
                axios.get('/api/categories')
                .then(response => {
                    this.categories = response.data.data
                })
            }).catch(error => {
                if (error.response && error.response.status) {
                    this.newHasError = true
                    console.log(error.response.data)
                    if (error.response.status == 422) {
                        this.newErrors = error.response.data.errors
                    }   
                } 
            })
        },

        async close() {
            this.hasError = false
            this.success = false
            this.name = null
        }
    },
}
</script>
