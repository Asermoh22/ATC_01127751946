<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;




class BookingApicontroller extends Controller
{
    public function book($id)
    {
        $user = Auth::user();
        if (!Auth::check()) {
    return response()->json(['message' => 'Unauthenticated'], 401);
}
           $event= Event::findOrFail($id);

           $existingBooking = Booking::where('event_id', $event->id)
                                  ->where('user_id', $user->id)
                                  ->first();

        if ($existingBooking) {
            return response()->json(['message' => 'Already booked'], 400);
        }

     Booking::create([
            'event_id' => $event->id,
            'user_id' => Auth::user()->id,
            'quantity' =>1,
        ]);


        return response()->json([
            'message' => 'Event booked successfully',
        ], 201);

    }





 public function cancel($id)
{
    $userId = Auth::id();

    $booking = Booking::where('event_id', $id)
                      ->where('user_id', $userId)
                      ->first();


    if (!$booking) {
        return response()->json(['message' => 'Not booked yet'], 404);
    }

    $booking->delete();

    return response()->json(['message' => 'booking canceled successfully!'], 200);
}
}
