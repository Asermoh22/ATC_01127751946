@extends('layout')

@section('title')
Home
@endsection

@section('content')
<link rel="stylesheet" href="{{ url('css/register.css') }}">
<nav class="navbar navbar-light" style="height: 70px;">
    <div class="container d-flex align-items-center justify-content-between">
        <h4 class="text-white mb-0">EventPass</h4>

       <ul class="nav-links d-flex align-items-center mb-0">
    <li><a href="{{ route('main.homepage') }}">Home</a></li>
    <li><a href="#">Contact</a></li>
        <li><a href="#">About</a></li>


    @if(Auth::user() && Auth::user()->role == 'admin')
        <li><a href="{{ route('dashboard.main') }}">Admin Panel</a></li>
    @endif

<li>
        <form action="{{ route('auth.logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-link logout-link" style="padding: 0; margin: 0; border: none; background: none;">
                Logout
            </button>
        </form>
    </li>
</ul>
    </div>
</nav>

<div class="advertisement-container">
    <div class="advertisement-text">
        <h1>Book Your Next Event with Us!</h1>
    </div>
</div>

<div class="container" style="position: relative; top: 100px;">
    <div class="row">
        @foreach ($events as $event)
            <div class="col-md-4 col-sm-6 col-12 mb-4 d-flex justify-content-center">
                <div class="event-card card w-100">

                    
                    <img src="{{ asset('uploads/events/' . $event->image) }}" class="card-img-top event-img" alt="Event Image">
               @if($event->bookings->where('user_id', Auth::id())->count())
            <a href="{{ route('events.cancel', $event->id) }}" 
               class="btn btn-outline-danger btn-sm rounded-circle position-absolute top-0 end-0 m-2" 
               style="width: 30px; height: 30px; line-height: 1;" 
               title="Cancel Booking">
                &times;
            </a>
        @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $event->Event_Name }}</h5>                            
                        <p class="card-text">
                            <strong>Date:</strong> {{ $event->Date }}<br>
                            <strong>Price:</strong> ${{ $event->price }}
                        </p>

                        @php
                        $userHasBooked = $event->bookings->contains('user_id', auth()->id());
                    @endphp
                    
                    @if (!$userHasBooked)
                        <form action="{{ route('events.show', $event->id) }}" method="Get">
                            @csrf
                            <button type="submit" class="btn btn-success w-100">Book Now</button>
                        </form>
                    @else
                        <button class="btn btn-danger w-100" disabled>Booked</button>
                    @endif
                    </div>
                </div>
            </div>
            {{-- {{ $events->links() }} --}}

        @endforeach


    </div>
</div>



@endsection
