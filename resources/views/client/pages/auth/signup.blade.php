@extends('client.layouts.auth')

@section('title')
    sign up
@endsection

@section('form')
    <form action="{{ route('signup') }}" method="Post">
        @csrf
        <div class="m-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" placeholder="name@example.com" name="email" value="{{ old('email') }}" required>
        </div>
        <div class="m-3">
            <label for="number" class="form-label">Phone number</label>
            <input type="number" class="form-control" id="number" placeholder="09xxxxxxxxx" name="number" value="{{ old('number') }}" required>
        </div>
        <div class="m-3">
            <label for="password" class="form-label">password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="m-3">
            <label for="confirm_password" class="form-label">confirm password</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
        </div>
        <div class="m-3 d-grid">
            <button type="submit" class="btn btn-dark m-3">sign up</button>
            <a class="nav-link text-center" href="{{ route('login_page') }}">already have an account</a>
        </div>
    </form>
@endsection