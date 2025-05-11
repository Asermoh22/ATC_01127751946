@extends('layout')

@section('title')
Register
@endsection

@section('content')
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
                <h2 class="text-center mb-4 fw-bold">Sign Up</h2>

                <form action="{{ route('auth.handelregister') }}" method="post">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select name="role" id="role" class="form-select" required>
                            <option value="" disabled selected>Select Role</option>
                            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>
                    

                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" required>
                        <div class="form-text">We'll never share your email with anyone else.</div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>

                    <button type="submit" class="btn btn-success w-100">Sign Up</button>
                </form>

                <div class="mt-3 text-center">
                    <a href="{{ route('auth.login') }}" class="btn btn-outline-primary w-100 d-block">Already have an account? Login</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection