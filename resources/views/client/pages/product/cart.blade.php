@extends('client.layouts.master')

@section('title')
cart
@endsection

@section('content')





<div class="container my-5">
@if (!auth()->user()->hasCart())
<p class="lead text-center">Cart is empty</p>
@else
     <div class="row">
    @foreach (auth()->user()->cart()->items() as $i)
        <div class="col-sm-12 my-1 d-flex">
            <div class="container-fluid d-flex">
                <a href="{{ route('product.show', $i->product_id) }}">
                    <img class="item-img me-3" src="{{ asset('storage/product/'.$i->product()->image()) }}" alt="">
                </a>
                <div class="d-grid">
                    <p class="lead mb-1">{{ $i->product()->name }}</p>
                    <p class="text-muted mb-1">{{ $i->product()->price }} toman</p>
                </div>
            </div>
            <div class="d-grid justify-content-end align-items-center w-100">
                <p class="text-muted mb-1 text-center">{{ $i->product()->price * $i->count }} toman</p>
                <hr class="my-0">
                <p class="text-muted mb-1 text-center">count : {{ $i->count }}</p>
            </div>
            <div class="my-1 mx-2 d-grid">
                <a href="{{ route('add_to_cart', $i->product_id) }}" class="btn btn-primary my-1">+</a>
                @if ($i->count > 0)
                <a href="{{ route('remove_from_cart', $i->product_id) }}" class="btn btn-danger my-1">
                    @if ($i->count == 1)
                    <i class="fa fa-trash"></i>
                    @else
                    -
                    @endif
                </a>
                @endif
            </div>
        </div>
        <hr>
    @endforeach
        <div class="d-flex flex-wrap justify-content-between align-items-center">
            <div class="col-md-4 d-flex align-items-center">
              <p class="mb-3 mb-md-0 text-muted">total price : </p>
            </div>
            <div class="nav col-md-4 justify-content-end d-flex">{{ auth()->user()->cart()->totalPrice() }} toman</div>
        </div>
    </div>
    <div class="m-1 d-grid">
        <a href="#" class="btn btn-dark m-3">Continue buying process</a>
    </div>
@endif
</div>

@endsection