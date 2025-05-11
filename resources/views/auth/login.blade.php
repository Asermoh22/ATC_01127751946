@extends('layout')

@section('title')
Login
@endsection

@section('content')


@if ($errors->any())
<div class="background-shadow" id="backgroundShadow"></div> <!-- Background shadow overlay -->
<div class="alert alert-danger" id="errorAlert">
    <span class="close" onclick="closeAlert()">&times;</span>
    <strong>Error!</strong>
    <p>Please fix the following issues:</p>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif 
<link rel="stylesheet" href="{{ url('css/register.css') }}">
<nav class="navbar navbar-light" style="height : 70px;">
    <div class="container">
        <h4 class="text-white">EventPass</h4>
    </div>
</nav>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4 shadow-sm rounded-3">
                <h2 class="text-center mb-4 fw-bold">Login</h2>

                <form action="{{ route('auth.handellogin') }}" method="post">
                    @csrf

                 

                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" required>
                        <div class="form-text">We'll never share your email with anyone else.</div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>

                    <button type="submit" class="btn btn-success w-100">Login</button>
                </form>

                <p class="signin">You don't have an account? <a href="{{ route('auth.register') }}">Signup</a></p>
            </div>
        </div>
    </div>
</div>
@endsection