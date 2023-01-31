@extends('client.layouts.master')

@section('title')
    Home
@endsection

@section('content')
{{-- {{ dd($recommended) }} --}}
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-6 my-3">
                <img src="{{ asset('storage/img/shop.jpg') }}" class="img-fluid" alt="shop image">
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
                    
                    @foreach ($recommended as $r)
                    <div class="carousel-item active">
                        <img src="{{ asset('storage/product/'.$r->image().'.jpg') }}" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                          <h5>{{ $r->name }}</h5>
                          {{-- <p>{{ $r->price }} toman</p> --}}
                        </div>
                      </div>
                    @endforeach
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
        <hr class="mt-5">
        <div class="row">
            <div class="col-sm-12">
                <p class="lead">popular products</p>
            </div>
            @foreach ($popular as $p)
            <div class="col-sm-4">
                <div class="card mb-10">
                    <img src="{{ asset('storage/product/'.$p->image().'.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $p->name }}</h5>
                        <p class="card-text">{{ $p->price }} toman</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <hr>
        <div class="row">
            <div class="col-sm-12">
                <p class="lead text-conter">newest products</p>
            </div>
            @foreach ($newest as $n)
            <div class="col-sm-4">
                <div class="card mb-10">
                    <img src="{{ asset('storage/product/'.$n->image().'.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $n->name }}</h5>
                        <p class="card-text">{{ $n->price }} toman</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection

@section('style')
<style>
    .card {
        margin : 10px;
    }
</style>
@endsection