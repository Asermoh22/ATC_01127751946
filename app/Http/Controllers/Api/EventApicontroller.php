<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

use Illuminate\Support\Facades\Auth;

class EventApicontroller extends Controller
{
    public function store(Request $request){
        $user=Auth::user();
        if(!$user || $user->role!='admin' ){
            return response()->json(['message' => 'Unauthorized'], 401);
        
        }
        
     $request->validate([
            'Event_Name'   => 'required|string',
            'Description'  => 'required|string',
            'category_id'  => 'nullable|integer|exists:categories,id',
            'Date'         => 'required|date',
            'Venue'        => 'required|string',
            'price'        => 'required|numeric',
            'image'        => 'required|image|mimes:jpg,png,webp,avif,jpeg',
        ]);


        $event_name=$request->Event_Name;
        $description=$request->Description;
        $category_id=$request->category_id;
        $date=$request->Date;
        $venue=$request->Venue;
        $price=$request->price;
        $image = $request->file('image');
        $exe = $image->getClientOriginalExtension();
        $imagename = 'evemt_' . uniqid() . '.' . $exe;
        $image->move(public_path('uploads/events'), $imagename);

        $event = Event::create([
        'Event_Name' => $event_name,
        'Description' => $description,
        'category_id' => $category_id,
        'Date' => $date,
        'Venue' => $venue,
        'price' => $price,
        'image' => $imagename,
    ]);

        return response()->json([
            'message' => 'Event created successfully',
            'event' => $event
        ], 201);

    }


    public function update(Request $request, $id){

 $user=Auth::user();
        if(!$user || $user->role!='admin' ){
            return response()->json(['message' => 'Unauthorized'], 401);
        
        }   

        $request->validate([
            'Event_Name'   => 'required|string|max:255',
            'Description'  => 'required|string',
            'category_id'  => 'required|integer|exists:categories,id',
            'Date'         => 'required|date',
            'Venue'        => 'required|string|max:255',
            'price'        => 'required|numeric',
            'image'        => 'nullable|image|mimes:jpg,png,webp,avif,jpeg|max:2048', 
        ]);
    
        $event = Event::findOrFail($id);
    
        $imagename = $event->image; 
    
        if ($request->hasFile('image')) {
            if ($event->image && file_exists(public_path('uploads/events/' . $event->image))) {
                unlink(public_path('uploads/events/' . $event->image));
            }
    
            $image = $request->file('image');
            $exe = $image->getClientOriginalExtension();
            $imagename = 'event_' . uniqid() . '.' . $exe;
            $image->move(public_path('uploads/events'), $imagename);
        }
    
        $event->update([
            'Event_Name' => $request->Event_Name,
            'Description' => $request->Description,
            'category_id' => $request->category_id,
            'Date' => $request->Date,
            'Venue' => $request->Venue,
            'price' => $request->price,
            'image' => $imagename,
        ]);


        return response()->json([
            'message' => 'Event updated successfully',
            'event' => $event
        ], 200);


    }

    public function delete($id){
        $user=Auth::user();
           if(!$user || $user->role!='admin' ){
            return response()->json(['message' => 'Unauthorized'], 401);
        
        }   

        $event = Event::findOrFail($id);
        $event->delete();
        return response()->json(['message' => 'Event deleted successfully'], 200);
    }

    public function show($id){
        $event = Event::findOrFail($id);
        return response()->json([
            'event' => $event
        ], 200);
    }
}
