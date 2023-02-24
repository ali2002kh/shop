<template>
    <page-header></page-header>
    <div class="container my-4">
        <div class="row">
            <div class="col-sm-4">
                <div class="container d-flex">
                    <img class="rounded-circle mx-3" src="storage/img/default.jpg" alt="">
                    <div class="d-grid">
                        <p class="text-muted mb-1">{{ user.number }}</p>
                        <p class="text-muted mb-1">{{ user.email }}</p>
                        <p class="text-muted mb-1">{{ user.fname }} {{ user.lname }}</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 text-center">
                <p class="text-muted mb-1 mt-3">number of orders : {{ user.orders.length }}</p>
            </div>
            <div class="col-sm-4 text-center">
                <button type="button" class="btn btn-dark my-4" data-bs-toggle="modal" data-bs-target="#editProfile">Edit account information</button>
            </div>
        </div>
        <hr>
    </div>

    
    <div class="container my-5" v-if="hasOrdered">
        <p class="mx-4 mb-4 lead">orders :</p>
        <div class="row">
            <div class="col-sm-4 rounded-3 my-1" 
            v-for="order in user.orders" :key="order.id">
                <hr>
                <div class="d-flex flex-wrap m-2 justify-content-between align-items-center">
                    <div class="justify-content-start">order code : </div>
                    <div class="justify-content-end">{{ order.code }}</div>
                </div>
                <div class="d-flex flex-wrap m-2 justify-content-between align-items-center">
                    <div class="justify-content-start">order amount : </div>
                    <div class="justify-content-end">{{ order.final_price }} toman</div>
                </div>
                <div class="d-flex flex-wrap m-2 justify-content-between align-items-center">
                    <div class="justify-content-start">order status : </div>
                    <div class="justify-content-end">{{ order.status }}</div>
                </div>
                <div class="m-1 d-grid">
                    <router-link :to="{name: 'order', params: {code: order.code}}" class="btn btn-info my-4">order info</router-link>
                </div>
            </div>
        </div>
    </div>
    

    <div class="modal fade" id="editProfile" tabindex="-1" aria-labelledby="editProfileLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editProfileLabel">Edit account information</h1>
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
                        <div class="m-1">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" 
                            id="email" name="email" v-model="email"
                            >
                        </div>
                        <div class="m-1">
                            <label for="fname" class="form-label">First name</label>
                            <input type="text" class="form-control" id="fname" name="fname"
                            v-model="fname"
                            >
                        </div>
                        <div class="m-1">
                            <label for="lname" class="form-label">last name</label>
                            <input type="text" class="form-control" id="lname" name="lname"
                            v-model="lname"
                            >
                        </div>
                        <div class="m-1">
                            <label for="number" class="form-label">Phone number</label>
                            <input type="text" class="form-control" 
                            id="number" name="number" v-model="number"
                            >
                        </div>
                        <div class="m-1">
                            <label for="password" class="form-label">password</label>
                            <input type="password" class="form-control" 
                            id="password" name="password" v-model="password"
                            >
                        </div>
                        <div class="m-1">
                            <label for="confirmPassword" class="form-label">confirm password</label>
                            <input type="password" class="form-control" 
                            id="confirmPassword" name="confirmPassword"
                            v-model="confirmPassword"
                            >
                        </div>
                        <div class="m-1 d-grid">
                            <button type="submit" class="btn btn-dark m-3" 
                            @click.prevent="update"
                            >Update</button>
                        </div>
                    </form>
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
            user: null,
            hasOrdered: false,
            email: null,
            number: null,
            fname: null,
            lname: null,
            password: null,
            confirmPassword: null,
            hasError: false,
            errors: [],
            success: false,
            message: null,
        }
    },
    created() {
        axios.get('/api/user')
        .then(response => {
            console.log(response.data.data)
            this.user = response.data.data;
            if (this.user.orders.length > 0) {
                this.hasOrdered = true;
            }
            this.email = this.user.email
            this.number = this.user.number
            this.fname = this.user.fname
            this.lname = this.user.lname
        });
    },  
    methods: {
        async update() {
            this.hasError = false
            this.errors = []
            this.success = false
            this.message = null
            try {
                await axios.post('/profile/update', {
                email: this.email,
                number: this.number,
                fname: this.fname,
                lname: this.lname,
                password: this.password,
                confirmPassword: this.confirmPassword,
            }).then(response => {
                this.success = true;
                this.message = response.data.message
            })
            } catch (error) {
                if (error.response && 
                    error.response.status && 
                    error.response.status == 422) {
                        this.hasError = true
                        console.log(error.response.data)
                        this.errors = error.response.data.errors
                }
            }
            
        } 
    },
}
</script>

<style scoped>
    .rounded-circle {
        width : 80px;
        height: 80px;
    } 
</style>