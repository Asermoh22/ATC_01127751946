@extends('layout')

@section('title')
Dashboard
@endsection

@section('content')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

<div class="dashboard-container">
    <!-- Sidebar -->
    <div class="dashboard-sidebar">
        <div class="sidebar-header">
            <h2 class="brand-title">EventPass</h2>
            <div class="brand-subtitle">Event Management</div>
        </div>
        <ul class="sidebar-nav">
            <li class="nav-item active">
                <a href="{{ route('main.homepage') }}" class="nav-link">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Events</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('events.create') }}" class="nav-link">
                    <i class="fas fa-tags"></i>
                    <span>Create Events</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </a>
            </li>
            <li class="btn btn-danger">
                <form action="{{ route('auth.logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="nav-link bg-transparent border-0 w-100 text-start">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </li>
        </ul>
    </div>

    <div class="dashboard-main">
        <nav class="dashboard-navbar">
            <div class="navbar-content">
                <h1 class="page-title">Dashboard</h1>
                <div class="user-profile">
                    <span class="user-name">Admin</span>
                </div>
            </div>
        </nav>

        <div class="dashboard-content container mt-4">
            <div id="eventsTable">
                <h3 class="mb-4">List of Events</h3>
                <table class="table table-bordered table-hover table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Event Name</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Date</th>
                            <th>Venue</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($events as $index => $event)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $event->Event_Name }}</td>
                                <td>{{ Str::limit($event->Description, 50) }}</td>
                                <td>{{ $event->category->name ?? 'N/A' }}</td>
                                <td>{{ $event->Date }}</td>
                                <td>{{ $event->Venue }}</td>
                                <td>${{ number_format($event->price, 2) }}</td>
                                <td>
                                    @if($event->image)
                                        <img src="{{ asset('uploads/events/' . $event->image) }}" width="60" alt="Event Image">
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('events.edit', $event->id) }}" class="btn btn-sm btn-primary me-1">Edit</a>
                                    <form action="{{ route('events.delete', $event->id) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">No events found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            

            <div id="usersTable" style="display: none;">
                <h3 class="mb-4">List of Users</h3>
                <table class="table table-bordered table-hover table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                             <th>Booking</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $index => $user)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                    @foreach ($user->bookings as $booking)
                        <td>{{ $booking->event->Event_Name }}</td>
                    @endforeach
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No users found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mb-4">
                <button class="btn btn-outline-primary" id="toggleTableBtn" onclick="toggleTables()">Show Users</button>
            </div>
        </div>
    </div>
</div>
<script>
    function toggleTables() {
        const eventsTable = document.getElementById('eventsTable');
        const usersTable = document.getElementById('usersTable');
        const toggleBtn = document.getElementById('toggleTableBtn');

        if (eventsTable.style.display === "none") {
            eventsTable.style.display = "block";
            usersTable.style.display = "none";
            toggleBtn.textContent = "Show Users";
        } else {
            eventsTable.style.display = "none";
            usersTable.style.display = "block";
            toggleBtn.textContent = "Show Events";
        }
    }
</script>

@endsection