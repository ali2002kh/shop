<template>
    <div class="container my-5">
        <div class="row">
            <div class="col-sm-6 m-10">
                <!-- @include('client.layouts.error') -->
                <form>
                    <div class="m-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" 
                        placeholder="name@example.com" name="email" required
                        v-model="email"
                        >
                    </div>
                    <div class="m-3">
                        <label for="number" class="form-label">Phone number</label>
                        <input type="text" class="form-control" id="number" 
                        placeholder="09xxxxxxxxx" name="number" required
                        v-model="number"
                        >
                    </div>
                    <div class="m-3">
                        <label for="password" class="form-label">password</label>
                        <input type="password" class="form-control" 
                        id="password" name="password" required
                        v-model="password"
                        >
                    </div>
                    <div class="m-3">
                        <label for="confirmPassword" class="form-label">confirm password</label>
                        <input type="password" class="form-control" 
                        id="confirmPassword" name="confirmPassword" required
                        v-model="confirmPassword"
                        >
                    </div>
                    <div class="m-3 d-grid">
                        <button type="submit" class="btn btn-dark m-3" 
                        @click.prevent="signup"
                        :disabled="loading"
                        >sign up</button>
                        <router-link class="nav-link text-center" :to="{name: 'login'}">already have an account</router-link>
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
            email: null,
            number: null,
            password: null,
            confirmPassword: null,
            loading: false,
        }
    },
    methods: {
        async signup () {
            this.loading = true;

            try {
                await axios.get("/sanctum/csrf-cookie")
                await axios.post("/signup", {
                    email: this.email,
                    number: this.number,
                    password: this.password,
                    confirmPassword: this.confirmPassword,
                }).then(response => {
                    this.$router.push('/');
                })
            } catch (error) {
                
            }

            this.loading = false;
        }  
    }, 
}
</script>