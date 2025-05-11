<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'Event_Name'   => 'required|string',
            'Description'  => 'required|string',
            'category_id'  => 'required|integer|exists:categories,id',
            'Date'         => 'required|date',
            'Venue'        => 'required|string',
            'price'        => 'required|numeric',
            'image'        => 'required|image|mimes:jpg,png,webp,avif,jpeg|max:2048',
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

        Event::create([
            'Event_Name' => $event_name,
            'Description' => $description,
            'category_id' => $category_id,
            'Date' => $date,
            'Venue' => $venue,
            'price' => $price,
            'image' => $imagename,
        ]);

        return redirect(route('main.homepage'));
    }
    public function update(Request $request, $id)
    {
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
    
        return redirect()->route('main.homepage')->with('success', 'Event updated successfully!');
    }

    public function show($id){


    $event = Event::with('Category')->findOrFail($id);
        // dd($event);
    return view('events.show', ['event'=>$event]);

    }

    public function delete($id){
        $event = Event::findOrFail($id);
        $event->delete();
        return redirect(route('main.homepage'));
    }
}

