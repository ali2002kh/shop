@extends('client.layouts.master')

@section('title')
    {{ $category->name }}
@endsection

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-sm-12 m-3">
            <p class="display-6">{{ $category->name }} category</p>
        </div>
        @foreach ($category->products() as $p)
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

@section('style')
<style>
    .card {
        margin : 10px;
    }
    .card-img-top {
        max-height: 400px;
        width: auto;
    }
</style>
@endsection