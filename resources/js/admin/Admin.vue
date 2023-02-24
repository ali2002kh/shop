<template>
    <div class="container-fluid">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li class="nav-item">
                        <router-link :to="{name: 'dashboard'}" class="nav-link align-middle px-0">
                            <i class="fa fa-dashboard"></i> <span class="ms-1 d-none d-sm-inline">Dashboard</span>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link align-middle px-0">
                            <i class="fa fa-shopping-bag"></i> <span class="ms-1 d-none d-sm-inline">Orders</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{name: 'products'}" class="nav-link align-middle px-0">
                            <i class="fa fa-gift"></i> <span class="ms-1 d-none d-sm-inline">Products</span>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{name: 'categories'}" class="nav-link align-middle px-0">
                            <i class="fa fa-windows"></i> <span class="ms-1 d-none d-sm-inline">Categories</span>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link align-middle px-0">
                            <i class="fa fa-gears"></i> <span class="ms-1 d-none d-sm-inline">settings</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col py-3">
            <router-view></router-view>
        </div>
    </div>
</div>
</template>

<script>

export default {
    created() {
        axios.get('/api/user')
        .then(response => {
            if (!response.data.data.is_admin) {
                this.$router.push('/')
            }
        }).catch(error => {
            if (error.response && 
            error.response.status && 
            error.response.status == 401) {
                console.log('401')
                this.$router.push('/login')
            };
        })
    },  
}
</script>