<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Shop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <router-link class="nav-link active" aria-current="page" :to="{name: 'home'}">Home</router-link>
                    </li>
                    
                        <li class="nav-item" v-if="isLoggedIn">
                        <a href="" class="nav-link position-relative">
                            <i class="fa fa-shopping-cart" style="font-size:25px"></i>
                            <!-- @if (auth()->user()->hasCart() && auth()->user()->cart()->countProducts() > 0)
                            <span class="position-absolute top-10 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ auth()->user()->cart()->countProducts() }}
                                <span class="visually-hidden">products in cart</span>
                            </span>
                            @endif -->
                        </a>
                        </li>
                        <li class="nav-item dropdown" v-if="isLoggedIn">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownAccount" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                account
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownAccount">
                                <li><a class="dropdown-item" href="">profile</a></li>
                                <li><a class="dropdown-item" 
                                    @click.prevent="logout" href="#"
                                    >logout</a></li>
                            </ul>
                        </li>
                    
                        <li class="nav-item" v-else>
                            <router-link :to="{name: 'login'}" class="nav-link">login/signup</router-link>
                        </li>
                    
                    <li class="nav-item">
                        <a href="" class="nav-link">products</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownCategory" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            categories
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownCategory">
                            <li v-for="c in categories" :key="c.id">
                                <a class="dropdown-item" href="">{{ c.name }}</a>
                            </li>
                        </ul>
                    </li>
                    
                </ul>
                <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#searchModal">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
    </nav>

    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="searchModalLabel">Search</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" id="search" name="search">
                    <br>
                    <div id="search-result" class="container d-grid mt-2"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            categories: null,
            user: null,
            isLoggedIn: false,
        } 
    },
    created() {
        axios.get('/api/categories')
        .then(response => {
            console.log(response.data.data)
            this.categories = response.data.data;
        });

        axios.get('/api/user')
        .then(response => {
            console.log(response.data.data)
            this.user = response.data.data;
            this.isLoggedIn = true;
        }).catch(error => {
            if (error.response && 
            error.response.status && 
            error.response.status == 401) {
                this.isLoggedIn = false;
                this.user = null;
            };
        });
    },
    methods: {
        async logout () {
            axios.post('/logout')
            .then(response => {
                this.isLoggedIn = false;
                this.user = null;
            })
        }
    },
}
</script>