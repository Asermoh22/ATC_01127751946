<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Event;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function book($id){
       
        $event= Event::findOrFail($id);
        // dd($event);

     Booking::create([
            'event_id' => $event->id,
            'user_id' => Auth::user()->id,
            'quantity' =>1,
        ]);


        return redirect()->back()->with('success', 'Event booked successfully!');
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

    return redirect()->back()->with('success', 'booking canceled successfully!');
}
}
