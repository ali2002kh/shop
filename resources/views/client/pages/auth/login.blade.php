@extends('client.layouts.auth')

@section('title')
    login
@endsection

@section('form')
    <form action="{{ route('login') }}" method="Post">
        @csrf
        <div class="m-3">
            <label for="email-or-number" class="form-label">Email or phon number</label>
            <input type="text" class="form-control" id="email-or-number" placeholder="name@example.com or 09xxxxxxxxx" name="email-or-number" value="{{ old('email-or-number') }}" required>
        </div>
        <div class="m-3">
            <label for="password" class="form-label">password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="m-3 d-grid">
            <button type="submit" class="btn btn-dark m-3">login</button>
            <a class="nav-link text-center" href="{{ route('signup_page') }}">new account</a>
        </div>
    </form>
@endsection