@extends('layout')

@section('title')
Create Event
@endsection

@section('content')
<link rel="stylesheet" href="{{ url('css/register.css') }}">
<nav class="navbar navbar-light bg-dark" style="height: 70px;">
    <div class="container">
        <h4 class="text-white">EventPass</h4>
    </div>
</nav>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card p-4 shadow-sm rounded-3">
                <h2 class="text-center mb-4 fw-bold">Edit Event</h2>

                <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="Event_Name" class="form-label">Event Name</label>
                        <input type="text" class="form-control" name="Event_Name" id="Event_Name" value="{{ $event->Event_Name }}">
                    </div>

                    <div class="mb-3">
                        <label for="Description" class="form-label">Description</label>
                        <textarea class="form-control" name="Description" id="Description" rows="3">{{ $event->Description }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select class="form-select" name="category_id" id="category_id" required>
                            <option selected disabled>Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="Date" class="form-label">Date</label>
                        <input type="date" class="form-control" name="Date" id="Date" value="{{ $event->Date }}">
                    </div>

                    <div class="mb-3">
                        <label for="Venue" class="form-label">Venue</label>
                        <input type="text" class="form-control" name="Venue" id="Venue" value="{{ $event->Venue }}">
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" step="0.01" class="form-control" name="price" id="price" value="{{ $event->price }}">
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Event Image</label>
                        <input type="file" class="form-control" name="image" id="image" accept="image/*">
                        
                        @if($event->image)
                            <div class="mt-2">
                                <p>Current Image:</p>
                                <img src="{{ asset('uploads/events/' . $event->image) }}" alt="Event Image" width="150" class="img-thumbnail">
                            </div>
                        @endif
                    </div>
                    

                    <button type="submit" class="btn btn-primary w-100">Create Event</button>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
