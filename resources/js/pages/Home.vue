<template>
    <page-header></page-header>
    <div class="container mt-5">
    <div class="row">
        <div class="col-sm-6 my-3">
            <img src="" class="img-fluid" alt="shop image">
        </div>
        <div class="col-sm-6 my-3">
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
                  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="4" aria-label="Slide 5"></button>
                </div>
                <div class="carousel-inner">
                    <a v-for="r in recommended" :key="r.id" href="">
                        <div class="carousel-item active">
                            <img src="" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>{{ r.name }}</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
    <popular></popular>
    <newest></newest>
</div>
<page-footer></page-footer>
</template>

<script>

import Popular from "../layouts/Popular"
import Newest from "../layouts/Newest"
import PageHeader from "../layouts/PageHeader"
import PageFooter from "../layouts/PageFooter"

export default {
    components: {
        Popular,
        Newest,
        PageHeader,
        PageFooter,
    },
    data() {
        return {
            recommended: null,
        } 
    },
    created() {
        axios.get('/api/recommended')
        .then(response => {
            console.log(response.data.data)
            this.recommended = response.data.data;
        });
    },
}
</script>