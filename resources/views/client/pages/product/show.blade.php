@extends('client.layouts.master')

@section('title')
{{ $product->name }}
@endsection

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-5 my-3">
                <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                    @foreach ($product->images() as $i)
                    <div class="carousel-item active">
                        <img src="{{ asset('storage/product/'.$i->link) }}" class="d-block w-100" alt="...">
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
            <div class="col-sm-3 my-3 text-center">
                <p class="display-6">{{ $product->name }}</p>
                <p class="lead">{{ $product->price }} toman</p>
                <p class="text-muted">number remaining : {{ $product->count }}</p>
                <p class="text-muted">category : {{ $product->category()->name }}</p>
                <a href="#" class="btn btn-primary">add to cart</a>
            </div>
            <div class="col-sm-3 m-4">
                <p>details : </p>
                <ul>
                    @foreach (json_decode($product->details, true) as $key => $value)
                    <li class="text-muted">{{ $key }} : {{ $value }}</li>
                    @endforeach
                </ul>
                <hr>
                <p>description : </p>
                <p class="text-muted">{{ $product->description }}</p>
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
                    <img src="{{ asset('storage/product/'.$p->image()) }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $p->name }}</h5>
                        <p class="card-text">{{ $p->price }} toman</p>
                        <a href="{{ route('product.show', $p->id) }}" class="btn btn-primary">details</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection