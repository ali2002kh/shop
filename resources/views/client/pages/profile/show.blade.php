@extends('client.layouts.master')

@section('title')
    profile
@endsection

@section('content')
    <div class="container my-5">
        @include('client.layouts.error')
        <div class="row">
            <div class="col-sm-4">
                <div class="container d-flex">
                    <img class="rounded-circle mx-3" src="{{ asset('storage/img/default.jpg') }}" alt="">
                    <div class="d-grid">
                        <p class="text-muted mb-1">{{ $user->number }}</p>
                        <p class="text-muted mb-1">{{ $user->email }}</p>
                        <p class="text-muted mb-1">{{ $user->fname }} {{ $user->lname }}</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 text-center">
                <p class="text-muted mb-1 mt-3">number of orders : 5</p>
                <p class="text-muted mb-1">balance : {{ $user->balance }} toman</p>
            </div>
            <div class="col-sm-4 text-center">
                <button type="button" class="btn btn-dark my-4" data-bs-toggle="modal" data-bs-target="#editProfile">Edit account information</button>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editProfile" tabindex="-1" aria-labelledby="editProfileLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editProfileLabel">Edit account information</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('profile.update') }}" method="Post">
                        @csrf
                        <div class="m-1">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" placeholder="name@example.com" name="email" value="{{ $user->email }}">
                        </div>
                        <div class="m-1">
                            <label for="fname" class="form-label">First name</label>
                            <input type="text" class="form-control" id="fname" name="fname" value="{{ $user->fname }}">
                        </div>
                        <div class="m-1">
                            <label for="lname" class="form-label">last name</label>
                            <input type="text" class="form-control" id="lname" name="lname" value="{{ $user->lname }}">
                        </div>
                        <div class="m-1">
                            <label for="number" class="form-label">Phone number</label>
                            <input type="text" class="form-control" id="number" placeholder="09xxxxxxxxx" name="number" value="{{ $user->number }}">
                        </div>
                        <div class="m-1">
                            <label for="password" class="form-label">password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="m-1">
                            <label for="confirm_password" class="form-label">confirm password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                        </div>
                        <div class="m-1 d-grid">
                            <button type="submit" class="btn btn-dark m-3">Update</button>
                        </div>
                    </form>
                </div>
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