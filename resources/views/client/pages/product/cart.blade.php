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
                <img class="item-img me-3" src="{{ asset('storage/product/'.$i->product()->image()) }}" alt="">
                <div class="d-grid">
                    <p class="lead mb-1">{{ $i->product()->name }}</p>
                    <p class="text-muted mb-1">{{ $i->product()->price }} toman</p>
                </div>
            </div>
            <div class="d-grid justify-content-between align-items-center">
                <p class="text-muted mb-1 text-center">{{ $i->product()->price * $i->count }} toman</p>
                <hr class="my-0">
                <p class="text-muted mb-1 text-center">count : {{ $i->count }}</p>
            </div>
            <a class="nav-link text-center"><i class="fa fa-trash" style="font-size:25px"></i></a>
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