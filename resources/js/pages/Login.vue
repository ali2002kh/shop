<template>
    <div class="container my-5">
        <div class="row">
            <div class="col-sm-6 m-10">
                <!-- @include('client.layouts.error') -->
                <form>
                    <div class="m-3">
                        <label for="emailOrNumber" class="form-label">Email or phon number</label>
                        <input type="text" class="form-control" 
                        id="emailOrNumber" placeholder="name@example.com or 09xxxxxxxxx" 
                        name="emailOrNumber" required
                        v-model="emailOrNumber"
                        >
                    </div>
                    <div class="m-3">
                        <label for="password" class="form-label">password</label>
                        <input type="password" class="form-control" 
                        id="password" name="password" required
                        v-model="password"
                        >
                    </div>
                    <div class="m-3 d-grid">
                        <button type="submit" class="btn btn-dark m-3" :disabled="loading"
                        @click.prevent="login"
                        >login</button>
                        <router-link class="nav-link text-center" :to="{name: 'signup'}">new account</router-link>
                    </div>
                </form>
            </div>
            <div class="col-sm-6 m-10">
                <img src="" class="img-fluid" alt="shop image">
            </div>
        </div> 
    </div>
</template>

<script>
export default {

    data() {
        return {
            emailOrNumber: null,
            password: null,
            loading: false,
        }
    },
    methods: {
        async login () {
            this.loading = true;

            try {
                await axios.get("/sanctum/csrf-cookie")
                await axios.post("/login", {
                    emailOrNumber: this.emailOrNumber,
                    password: this.password,
                }).then(response => {
                    this.$router.push('/') 
                })
            } catch (error) {
                
            }

            this.loading = false;
        }  
    }, 
}
</script>