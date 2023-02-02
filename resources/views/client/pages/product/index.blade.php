@extends('client.layouts.master')

@section('title')
    all products
@endsection

@section('content')

<div class="container my-5 d-flex">
    <form action="{{ route('product.filter') }}" method="Post" class="d-flex">
        @csrf
        <select name="sort" class="form-select mx-2">
            <option value="created_at" @if (!Session::has('sort') || Session::get('sort') == "created_at") selected @endif>newest</option>
            <option value="sold"@if (Session::get('sort') == "sold") selected @endif>most popular</option>
            <option value="cheap"@if (Session::get('sort') == "cheap") selected @endif>cheapest</option>
            <option value="price"@if (Session::get('sort') == "price") selected @endif>most expensive</option>
        </select>
        <select name="category" class="form-select mx-2">
            <option value="all"@if (!Session::has('category') || Session::get('category') == 'all') selected @endif>all</option>
            @foreach ($categories as $c)
                <option value="{{ $c->id }}"@if (Session::get('category') == $c->id) selected @endif>{{ $c->name }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-dark mx-2">submit</button>
    </form>
</div>

<div class="container my-5">
    <div class="row">
        @foreach ($products as $p)
        <div class="col-sm-3">
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
        {{ $products->links() }}
    </div>
</div>

@endsection

@section('style')
<style>
    .card {
        margin : 10px;
    }
    .card-img-top {
        max-height: 300px;
        width: auto;
    }
</style>
@endsection