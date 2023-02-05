@extends('client.layouts.master')

@section('title')
    order : {{ $order->code }}
@endsection

@section('content')

<div class="container d-grid">
        <div class="d-flex flex-wrap m-2 justify-content-between align-items-center" style="max-width:200px">
            <div class="justify-content-start">order code : </div>
            <div class="justify-content-end">{{ $order->code }}</div>
        </div>
        <div class="d-flex flex-wrap m-2 justify-content-between align-items-center" style="max-width:200px">
            <div class="justify-content-start">status : </div>
            <div class="justify-content-end">{{ $order->status() }}</div>
        </div>
        <hr>
    

    <div class="row">
    @foreach ($order->cart()->items() as $i)
        <div class="col-sm-12 my-1 d-flex">
            <div class="container-fluid d-flex align-items-center">
                <img class="item-img me-3" src="{{ asset('storage/product/'.$i->product()->image()) }}" alt="">
                <div class="d-grid">
                    <p class="lead mb-1">{{ $i->product()->name }}</p>
                    <p class="text-muted mb-1">{{ $i->old_price }} toman</p>
                </div>
            </div>
            <div class="d-grid justify-content-end align-items-center w-100">
                <p class="text-muted m-2 text-center">{{ $i->old_price * $i->count }} toman</p>
                <hr class="my-0">
                <p class="text-muted m-2 text-center">count : {{ $i->count }}</p>
            </div>
        </div>
        <br>
    @endforeach
    <div class="d-flex flex-wrap justify-content-between align-items-center m-3">
        <div class="justify-content-start lead">total price : </div>
        <div class="justify-content-end lead">{{ $order->final_price }} toman</div>
    </div>
    </div>

</div>

@endsection

@section('style')
<style>
    .rounded-circle {
        width : 80px;
        height: 80px;
    } 
</style>
@endsection