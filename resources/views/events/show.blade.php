@extends('layout')

@section('title')
    {{ $event->Event_Name }}
@endsection

@section('content')
<link rel="stylesheet" href="{{ url('css/show.css') }}">

<nav class="navbar navbar-light" style="height: 70px;">
    <div class="container d-flex align-items-center justify-content-between">
        <h4 class="text-white mb-0">EventPass</h4>

        <ul class="nav-links d-flex align-items-center mb-0">
            <li><a href="{{ route('main.homepage') }}">Home</a></li>
            <li><a href="{{ route('auth.logout') }}" class="logout-link">Logout</a></li>
        </ul>
    </div>
</nav>

<div class="event-container">
    <div class="event-card">
        <div class="event-image-container">
            <img src="{{ asset('uploads/events/' . $event->image) }}" alt="{{ $event->Event_Name }}" class="event-image">
        </div>
        <div class="event-details">
            <h1>{{ $event->Event_Name }}</h1>
            <div class="description-box">
                <p class="description">{{ $event->Description }}</p>
            </div>            
            <h2 class="category-title">{{ $event->Category->name }}</h2> 
            <p><strong>📅 Date:</strong> {{ $event->Date }}</p>
            <p><strong>📍 Location:</strong> {{ $event->Venue }}</p>
            <p><strong>💰 Price:</strong> {{ $event->price }} EGP</p>


            <form action="{{ route('book.events', $event->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn-book">Book Now</button>
            </form>
        </div>
    </div>
    @if(session('success'))
    <div class="overlay">
        <div class="congrats-modal">
            <h2>🎉 Congratulations!</h2>
            <p>{{ session('success') }}</p>
            <a href="{{ route('main.homepage') }}" class="btn-book">Go Back Home</a>
        </div>
    </div>
@endif
</div>
@endsection
